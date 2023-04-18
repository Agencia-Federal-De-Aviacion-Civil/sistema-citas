<?php

namespace App\Http\Livewire\Medicine;

use App\Models\appointment\user_appointment_success;
use App\Models\appointment\userAppointment;
use App\Models\Medicine\MedicineInitial;
use App\Models\Medicine\MedicineRenovation;
use App\Models\Medicine\MedicineReserve;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    public $name, $type, $class, $typLicense, $sede, $date, $time, $idAppointmet, $headquarterid;
    public $medicineInitial, $medicineReserves, $medicineDelete;
    public function render()
    {
        $appointment = MedicineReserve::query()
        ->selectRaw("count(id) as registradas")
        ->first();
        $registradas = $appointment->registradas;
        $this->medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'user'])->get();
        return view('livewire.medicine.history-appointment',compact('registradas'))
            ->layout('layouts.app');
    }
    public function rescheduleAppointment($id)
    {

        $appointment = userAppointment::with([
            'appointmentUser', 'appointmentStudying', 'appointmentRenovation', 'appointmentSuccess',
            'appointmentTypeExam', 'appointmentDocument'
        ])
            ->where('user_appointment_success_id', $id)->get();
        $this->name = $appointment[0]->appointmentUser->name . ' ' . $appointment[0]->appointmentUser->apParental . ' ' . $appointment[0]->appointmentUser->apMaternal;
        $this->type = $appointment[0]->appointmentTypeExam->name;
        if ($appointment[0]->appointmentTypeExam->id == 1) {
            $this->class = $appointment[0]->appointmentStudying[0]->studyingClass->name;
            $this->typLicense = $appointment[0]->appointmentStudying[0]->studyingClasification->name;
        } else {
            $this->class = $appointment[0]->appointmentRenovation[0]->renovationClass->name;
            $this->typLicense = $appointment[0]->appointmentRenovation[0]->renovationClasification->name;
        }
        $this->sede = $appointment[0]->appointmentSuccess->successUser->name;
        $this->date = $appointment[0]->appointmentSuccess->appointmentDate;
        $this->time = $appointment[0]->appointmentSuccess->appointmentTime;
        $this->idAppointmet = $appointment[0]->appointmentSuccess->id;
        $this->headquarterid = $appointment[0]->appointmentSuccess->to_user_headquarters;
        $this->openModal();
    }
    public function deletAppointment($id)
    {
        
        $medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'user'])
        ->whereHas('medicineReserveMedicine.medicineUser', function ($q1) use ($id) {
        $q1->where('id', $id);
        })->get();
        
        $this->medicineDelete = $medicineReserves[0]->id;
        
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
        $medicineDelete = MedicineReserve::find($this->medicineDelete);
        $medicineDelete->delete();
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

        $user_appointment = user_appointment_success::where('appointmentDate', $this->date)
            ->where('appointmentTime', $this->time)
            ->where('to_user_headquarters', $this->headquarterid)
            ->get();

        if ($this->time <= '08:00:00' && $user_appointment->count() == 4) {
            //dd('13 citas');
            $this->modal = false;
            return $this->notification([
                'title'       => 'Citas no disponibles en la fecha indicada',
                'icon'        => 'warning'
            ]);
        } else
        if ($this->time > '08:00:00' && $user_appointment->count() == 4) {
            //dd('12 citas');
            $this->modal = false;
            return $this->notification([
                'title'       => 'Citas no disponibles en la fecha indicada',
                'icon'        => 'warning'
            ]);
        }

        $appointmet =  user_appointment_success::find($this->idAppointmet);
        $appointmet->update(
            [
                'appointmentDate' => $this->date,
                'appointmentTime' => $this->time
            ]
        );
        $this->modal = false;
        $this->acuse();

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

    // public function returnView()
    // {
    //     return redirect()->route('afac.home');
    // }
    public function download()
    {
        $id = $this->idAppointmet;
        return redirect()->route('downloads', compact('id'));
    }
    public function test()
    {

        $printQuery = userAppointment::with(['appointmentTypeExam', 'appointmentStudying', 'appointmentRenovation', 'appointmentSuccess'])
            ->where('user_appointment_success_id', $_GET['id'])->latest()->first();
        // sumando las citas
        $sumappointment = user_appointment_success::where('appointmentDate', $printQuery->appointmentSuccess->appointmentDate)
            ->where('appointmentTime', $printQuery->appointmentSuccess->appointmentTime)
            ->where('to_user_headquarters', $printQuery->appointmentSuccess->to_user_headquarters)->get();

        $sumappointment = count($sumappointment);

        if ($printQuery->type_exam_id == 1) {
            $pdf = PDF::loadView('livewire.appointment.documents.appointment-pdf', compact('printQuery', 'sumappointment'));
            return $pdf->download($printQuery->paymentDate . '-' . $printQuery->appointmentTypeExam->name . ' cita.pdf');
        } else if ($printQuery->type_exam_id == 2) {
            $pdf = PDF::loadView('livewire.appointment.documents.appointment-pdf2', compact('printQuery', 'sumappointment'));
            return $pdf->download($printQuery->paymentDate . '-' . $printQuery->appointmentTypeExam->name . ' cita.pdf');
        }
    }
}
