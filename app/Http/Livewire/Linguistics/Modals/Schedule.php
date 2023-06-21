<?php

namespace App\Http\Livewire\Linguistics\Modals;

use App\Models\Catalogue\Headquarter;
use App\Models\Linguistic\LinguisticHistoryMovements;
use App\Models\Linguistic\LinguisticReserve;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class Schedule extends ModalComponent
{
    use Actions;
    use WithFileUploads;
    public $scheduleId, $linguisticId;
    public $name, $status,$type,$typLicense,$license_number,$red_number,$sedes,$sede,$hoursReserve,$dateReserve;
    public function mount($scheduleId, $linguisticId)
    {
        $this->scheduleId = $scheduleId;
        $this->linguisticId = $linguisticId;
        $this->valores($this->scheduleId);
        $this->sedes = Headquarter::where('system_id', 2)->where('status', false)->get();

    }
    public function render()
    {
        return view('livewire.linguistics.modals.schedule');
    }
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
    public function valores($cheduleId)
    {

        $this->scheduleId = $cheduleId;
        $linguisticReserves = LinguisticReserve::with([
            'linguisticReserveFromUser',
            'linguisticReserve',
            'linguisticReserveSchedule'
        ])->where('id', $this->scheduleId)->get();

        $this->name = $linguisticReserves[0]->linguisticReserveFromUser->name. ' ' .
        $linguisticReserves[0]->linguisticReserveFromUser->UserParticipant[0]->apParental. ' ' .
        $linguisticReserves[0]->linguisticReserveFromUser->UserParticipant[0]->apMaternal;

        $this->type = $linguisticReserves[0]->linguisticReserve->linguisticTypeExam->name;
        $this->typLicense = $linguisticReserves[0]->linguisticReserve->linguisticTypeLicense->name;
        $this->license_number = $linguisticReserves[0]->linguisticReserve->license_number;
        $this->red_number = $linguisticReserves[0]->linguisticReserve->red_number;
        $this->sede = $linguisticReserves[0]->linguisticUserHeadquers->name;
        $this->dateReserve = $linguisticReserves[0]->date_reserve;
        $this->hoursReserve = $linguisticReserves[0]->linguisticReserveSchedule->time_start;
        $this->status = $linguisticReserves[0]->status;

        // $this->id_appoint = $linguisticReserves[0]->id;

        // if ($linguisticReserves[0]->medicineReserveMedicine->medicineTypeExam->id == 1) {
        //     $this->class = $linguisticReserves[0]->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name;
        //     $this->typLicense = $linguisticReserves[0]->medicineReserveMedicine->medicineInitial[0]->medicineInitialClasificationClass->name;
        // } else if ($linguisticReserves[0]->medicineReserveMedicine->medicineTypeExam->id == 2) {
        //     $this->class = $linguisticReserves[0]->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name;
        //     $this->typLicense = $linguisticReserves[0]->medicineReserveMedicine->medicineRenovation[0]->renovationClasificationClass->name;
        // }
        // $this->to_user_headquarters = $linguisticReserves[0]->user->name;
        // $this->dateReserve = $linguisticReserves[0]->dateReserve;


        // $this->hoursReserve = $linguisticReserves[0]->reserveSchedule->time_start;

        // if (empty($linguisticReserves[0]->reserveObserv[0]->observation)) {
        //     $this->comment;
        // } else {

        //     if (!empty($linguisticReserves[0]->reserveObserv[0]->observation)) {
        //         $this->comment1 = $linguisticReserves[0]->reserveObserv[0]->observation;
        //     } else {
        //         $this->comment1;
        //     }
        //     if (!empty($linguisticReserves[0]->reserveObserv[1]->observation)) {
        //         $this->comment2 = $linguisticReserves[0]->reserveObserv[1]->observation;
        //     } else {
        //         $this->comment2;
        //     }
        //     $this->comment = $this->comment1 . ' / ' . $this->comment2;
        // }

        // $this->sede = $linguisticReserves[0]->user->name;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function reschedules()
    {
        //ASISTIÓ
        if ($this->selectedOption == 1) {

            $attendeReserve = LinguisticReserve::find($this->scheduleId);
            $attendeReserve->update([
                'status' => $this->selectedOption,
            ]);
            $this->emit('attendeReserve');
            $accion = 'VALIDO CITA';
            //CANCELO EL ADMIN
        } elseif ($this->selectedOption == 2) {

            $this->validate([
                'comment_cancelate' => 'required',
            ]);
            $observation = new MedicineObservation();
            $observation->medicine_reserve_id = $this->scheduleId;
            $observation->observation = $this->comment_cancelate;
            $observation->status = 2;
            $observation->save();
            $cancelReserve = LinguisticReserve::find($this->scheduleId);
            $cancelReserve->update([
                'status' => $this->selectedOption,
            ]);
            $this->emit('cancelReserve');
            $accion = 'CANCELO CITA';
            //REAGENDO
        } elseif ($this->selectedOption == 4) {
            $accion = 'REAGENDO CITA';
            $this->validate([
                'comment' => 'required',
                'to_user_headquarters' => 'required',
                'medicine_schedule_id' => 'required'

            ]);
            $observation = new MedicineObservation();
            $observation->medicine_reserve_id = $this->scheduleId;
            $observation->observation = $this->comment;
            $observation->status = 4;
            $observation->save();
            $citas = LinguisticReserve::where('to_user_headquarters', $this->to_user_headquarters)
                ->where('dateReserve', $this->dateReserve)
                ->where(function ($query) {
                    $query->where('status', 0)
                        ->orWhere('status', 1)
                        ->orWhere('status', 4);
                })
                ->count();
            switch ($this->to_user_headquarters) {
                case 7: // CIUDAD DE MEXICO
                    $maxCitas = 50;
                    break;
                case 2: // CANCUN
                case 3: // TIJUANA
                case 4: // TOLUCA
                case 5: // MONTERREY
                case 518: //MAZATLAN SINALOA
                case 519: //CHIAPAS
                case 520: //VERACRUZ
                case 521: //HERMOSILLO SONORA
                    $maxCitas = 10;
                    break;
                case 522: //QUERETARO
                    $maxCitas = 10;
                    break;
                case 7958: //SINALOA CULIACAN
                    $maxCitas = 10;
                    break;
                case 6: // GUADALAJARA
                    $maxCitas = 20;
                    break;
                case 523: // YUCATAN
                    $maxCitas = 5;
                    break;
                default:
                    $maxCitas = 0;
                    break;
            }
            if ($citas >= $maxCitas) {
                $this->notification([
                    'title'       => 'CITA NO GENERADA!',
                    'description' => 'No hay citas disponibles para ese dia',
                    'icon'        => 'error'
                ]);
            } else {
                $cita = LinguisticReserve::find($this->scheduleId);
                $cita->to_user_headquarters = $this->to_user_headquarters;
                $cita->dateReserve = $this->dateReserve;
                $cita->status = $this->selectedOption;
                $cita->save();
                $this->emit('reserveAppointment');
            }
        } else {
            $this->validate();
        }
        //Historial de validar cita
        LinguisticHistoryMovements::create([
            'user_id' => Auth::user()->id,
            'action' => $accion,
            'process' => $this->name . ' FOLIO CITA:' . $this->id_appoint
        ]);
        $this->closeModal();
    }

}
