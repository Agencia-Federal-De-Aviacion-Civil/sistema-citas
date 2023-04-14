<?php

namespace App\Http\Livewire\Medicine;

use App\Models\appointment\user_appointment_success;
use App\Models\appointment\userAppointment;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use PDF;

class HistoryAppointment extends Component
{
    use Actions;
    use WithFileUploads;
    public $n = 1;
    public $modal = false;
    public $name, $type, $class, $typLicense, $sede, $date, $time, $idAppointmet, $headquarterid,$dateReserve;
    public $medicineInitial, $medicineReserves, $medicineDelete,$typeExam,$to_user_headquarters,$idReserve;
    public function render()
    {
        $this->medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'user'])->get();
        return view('livewire.medicine.history-appointment')
            ->layout('layouts.app');
    }
    public function rescheduleAppointment($id)
    {
        // dd($id);
        $medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'user'])
        ->where('id',$id)->get();        
        $this->name = $medicineReserves[0]->medicineReserveMedicine->medicineUser->name.' '.$medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant[0]->apParental.' '.$medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant[0]->apMaternal; 
        $this->type = $medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->name;

        if ($medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->id == 1) {
            $this->class = $medicineReserves[0]->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name;
            $this->typLicense = $medicineReserves[0]->medicineReserveMedicine->medicineInitial[0]->medicineInitialClasificationClass->name;
        } else if($medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->id == 2){
            $this->class = $medicineReserves[0]->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name;
            $this->typLicense = $medicineReserves[0]->medicineReserveMedicine->medicineRenovation[0]->renovationClasificationClass->name;
        }
        $this->sede = $medicineReserves[0]->user->name;
        $this->dateReserve = $medicineReserves[0]->dateReserve;
        $this->to_user_headquarters = $medicineReserves[0]->to_user_headquarters;
        $this->idReserve = $id;

        $this->openModal();
    }
    public function deletAppointment($id)
    {
        $medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'user'])
        ->whereHas('medicineReserveMedicine.medicineUser', function ($q1) use ($id) {
        $q1->where('id', $id);
        })->get();        
        $this->medicineDelete = $medicineReserves[0]->id;
        $this->typeExam = $medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->id;        
        $this->dialog()->confirm([
            'title'       => 'CITA DE ' . $medicineReserves[0]->medicineReserveMedicine->medicineUser->name,
            'description' => '¿DESEAS ELIMINAR ESTA CITA?',
            'icon'        => 'question',
            'accept'      => [
                'label'  => 'SI',
                'method' => 'delete',
            ],
            'reject' => [
                'label'  => 'NO',
            ],
        ]);
    }
    public function delete()
    {
        $medicineDelete = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'user'])
        ->where('id',$this->medicineDelete)->get();        
        $medicineDelete[0]->medicineReserveMedicine->delete();
        $this->notification([
            'title'       => 'SE ELIMINO CITA CON ÉXITO',
            'icon'        => 'error',
            'timeout' => 3300
        ]);
    }

    public function openModal()
    {
        $this->modal = true;
    }
    public function salir()
    {
        $this->modal = false;
    }
    
    public function reschedule()
    {
        $citas = MedicineReserve::where('to_user_headquarters', $this->to_user_headquarters)
            ->where('dateReserve', $this->dateReserve)
            ->count();
        switch ($this->to_user_headquarters) {
            case 2: // Cancun
            case 3: // Tijuana
            case 4: // Toluca
            case 5: // Monterrey
                $maxCitas = 10;
                break;
            case 7: // Guadalajara
                $maxCitas = 20;
                break;
            case 9: // Ciudad de Mexico
                $maxCitas = 50;
                break;
            default:
                $maxCitas = 0;
                break;
        }
        if ($citas >= $maxCitas) {
            $this->notification([
                'title'       => 'ERROR DE CITA!',
                'description' => 'No hay citas disponibles para ese dia',
                'icon'        => 'error'
            ]);
        } else {

            $appointmet =  MedicineReserve::find($this->idReserve);
            $appointmet->update(
            [
            'dateReserve' => $this->dateReserve
            ]
            );            
        }
        $this->modal = false;
        $this->acuse();
        session(['saved_reserv_id' => $this->idReserve]);
        // $this->notification([
        //     'title'       => 'Cita reagendada',
        //     'icon'        => 'success'
        // ]);        
    }
    public function acuse()
    {
        $this->dialog()->confirm([
            'title'       => 'CITA REAGENDADA',
            'description' => '¿DESEAS IMPRIMIR ACUSE?',
            'icon'        => 'success',
            'accept'      => [
                'label'  => 'IMPRIMIR',
                'method' => 'download',
            ],
            'reject' => [
                'label'  => 'SALIR',
            ],
        ]);
    }
    public function download()
    {
        return redirect()->route('downloads');
    }
    public function test()
    {
        $updateReservId = session('saved_reserv_id');
        $medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'user'])
            ->where('medicine_id', $updateReservId)->get();
        $curpKey = $medicineReserves[0]->medicineReserveMedicine->medicineUser->userParticipant->pluck('id')->first();
        $keyEncrypt =  Crypt ::encryptString($curpKey);
        if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 1) {
            $pdf = PDF::loadView('livewire.medicine.documents.medicine-initial', compact('medicineReserves', 'keyEncrypt'));
            return $pdf->download($medicineReserves[0]->dateReserve . '-' . 'cita.pdf');
        } else if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 2) {
            $pdf = PDF::loadView('livewire.medicine.documents.medicine-renovation', compact('medicineReserves', 'keyEncrypt'));
            return $pdf->download($medicineReserves[0]->dateReserve . '-' . 'cita.pdf');
        }
    }
}