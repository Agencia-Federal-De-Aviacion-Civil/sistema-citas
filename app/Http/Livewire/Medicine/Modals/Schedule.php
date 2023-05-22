<?php

namespace App\Http\Livewire\Medicine\Modals;

use App\Models\Catalogue\Headquarter;
use App\Models\Medicine\Medicine;
use App\Models\Medicine\MedicineObservation;
use App\Models\Medicine\MedicineReserve;
use App\Models\Medicine\MedicineSchedule;
use App\Models\Observation;
use Illuminate\Support\Facades\Date;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\Modal;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class Schedule extends ModalComponent
{
    use Actions;
    use WithFileUploads;
    public $comment1, $comment2, $scheduleId, $status, $medicineReserves, $name, $type, $class, $typLicense, $sede, $dateReserve, $date, $time, $scheduleMedicines, $sedes,
        $to_user_headquarters, $medicine_schedule_id, $selectedOption, $comment, $comment_cancelate, $hoursReserve, $observation, $medicineId;

    public function rules()
    {
        return [
            'comment' => '',
            'comment_cancelate' => '',
            'selectedOption' => 'required',
            'to_user_headquarters' => '',
            'medicine_schedule_id' => ''
        ];
    }

    public function mount($scheduleId, $medicineId)
    {
        $this->scheduleId = $scheduleId;
        $this->medicineId = $medicineId;
        $this->valores($this->scheduleId);
        $this->sedes = Headquarter::where('system_id', 1)->get();
        $this->scheduleMedicines = collect();
        Date::setLocale('ES');
        $this->date = Date::now()->parse();
    }
    public function render()
    {

        return view('livewire.medicine.modals.schedule');
    }
    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
    public function valores($cheduleId)
    {

        $this->scheduleId = $cheduleId;
        $medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'user'])
            ->where('id', $this->scheduleId)->get();
        $this->name = $medicineReserves[0]->medicineReserveMedicine->medicineUser->name . ' ' . $medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant[0]->apParental . ' ' . $medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant[0]->apMaternal;
        $this->type = $medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->name;

        if ($medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->id == 1) {
            $this->class = $medicineReserves[0]->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name;
            $this->typLicense = $medicineReserves[0]->medicineReserveMedicine->medicineInitial[0]->medicineInitialClasificationClass->name;
        } else if ($medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->id == 2) {
            $this->class = $medicineReserves[0]->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name;
            $this->typLicense = $medicineReserves[0]->medicineReserveMedicine->medicineRenovation[0]->renovationClasificationClass->name;
        }
        $this->to_user_headquarters = $medicineReserves[0]->user->name;
        $this->dateReserve = $medicineReserves[0]->dateReserve;

        $this->status = $medicineReserves[0]->status;

        $this->hoursReserve = $medicineReserves[0]->reserveSchedule->time_start;

        if (empty($medicineReserves[0]->reserveObserv[0]->observation)) {
            $this->comment;
        } else {

            if (!empty($medicineReserves[0]->reserveObserv[0]->observation)) {
                $this->comment1 = $medicineReserves[0]->reserveObserv[0]->observation;
            } else {
                $this->comment1;
            }
            if (!empty($medicineReserves[0]->reserveObserv[1]->observation)) {
                $this->comment2 = $medicineReserves[0]->reserveObserv[1]->observation;
            } else {
                $this->comment2;
            }
            $this->comment = $this->comment1 . ' / ' . $this->comment2;
        }

        $this->sede = $medicineReserves[0]->user->name;
    }
    public function updatedToUserHeadquarters($value)
    {
        // Obtener los horarios disponibles para la fecha especificada
        $this->scheduleMedicines = MedicineSchedule::where('user_id', $value)
            ->get();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function reschedules()
    {

        //ASISTIÓ
        if ($this->selectedOption == 1) {

            $attendeReserve = MedicineReserve::find($this->scheduleId);
            $attendeReserve->update([
                'status' => $this->selectedOption,
            ]);
            $this->emit('attendeReserve');
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
            $cancelReserve = MedicineReserve::find($this->scheduleId);
            $cancelReserve->update([
                'status' => $this->selectedOption,
            ]);
            $this->emit('cancelReserve');
            //REAGENDO
        } elseif ($this->selectedOption == 4) {
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
            $citas = MedicineReserve::where('to_user_headquarters', $this->to_user_headquarters)
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
                case 528: //MAZATLAN SINALOA
                case 529: //CHIAPAS
                case 530: //VERACRUZ
                case 531: //HERMOSILLO SONORA
                case 532: //QUERETARO
                    $maxCitas = 10;
                    break;
                case 6: // GUADALAJARA
                    $maxCitas = 20;
                    break;
                case 533: // YUCATAN
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
                $cita = MedicineReserve::find($this->scheduleId);
                $cita->to_user_headquarters = $this->to_user_headquarters;
                $cita->dateReserve = $this->dateReserve;
                $cita->status = $this->selectedOption;
                $cita->save();
                $this->emit('reserveAppointment');
            }
        } else {
            $this->validate();
        }
        $this->closeModal();
    }
    public function saveActive()
    {
        $activeReserve = Medicine::find($this->medicineId);
        $activeReserve->update([
            'reference_number' => 'ACTIVE' . '-' . $this->medicineId,
        ]);
        $this->notification([
            'title'       => 'LLAVE DE PAGO LIBERADA!',
            'description' => 'La llave de pago se liberó.',
            'icon'        => 'info',
            'timeout' => '3100'
        ]);
        $this->closeModal();
        $this->emit('reserveAppointment');
    }
    public function messages()
    {
        return [
            'comment_cancelate.required' => 'Campo obligatorio',
            'comment.required' => 'Campo obligatorio',
            'selectedOption.required' => 'Seleccione opción',
            'to_user_headquarters.required' => 'Seleccione opción',
            'medicine_schedule_id.required' => 'Seleccione opción'
        ];
    }
}
