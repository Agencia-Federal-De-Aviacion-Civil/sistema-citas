<?php

namespace App\Http\Livewire\Medicine\Modals;

use App\Models\Catalogue\Headquarter;
use App\Models\Medicine\Medicine;
use App\Models\Medicine\MedicineObservation;
use App\Models\Medicine\MedicineReserve;
use App\Models\Medicine\MedicineSchedule;
use App\Models\Medicine\medicine_history_movements;
use App\Models\Medicine\MedicineDisabledDays;
use App\Models\Medicine\MedicineScheduleException;
use Illuminate\Support\Facades\Auth;
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
        $headquarter_id, $medicine_schedule_id, $selectedOption, $comment, $comment_cancelate, $hoursReserve, $observation, $medicineId, $accion,
        $disabledDaysFilter;

    public function rules()
    {
        return [
            'comment' => 'required_if:selectedOption,4',
            'comment_cancelate' => 'required_if:selectedOption,2',
            'selectedOption' => 'required',
            'headquarter_id' => 'required_if:selectedOption,4',
            'medicine_schedule_id' => 'required_if:selectedOption,4',
            'dateReserve' => 'required_if:selectedOption,4'
        ];
    }

    public function mount($scheduleId, $medicineId)
    {
        $this->scheduleId = $scheduleId;
        $this->medicineId = $medicineId;
        $this->valores($this->scheduleId);
        $this->sedes = Headquarter::where('system_id', 1)->where('status', false)->get();
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
    public function updatedHeadquarterId($value)
    {
        $this->scheduleMedicines = MedicineSchedule::with('scheduleHeadquarter')
            ->whereHas('scheduleHeadquarter', function ($max) use ($value) {
                $max->where('id', $value);
            })->where('status', 0)->get();
        $this->searchDisabledDays();
        $this->dateReserve = '';
    }
    public function searchDisabledDays()
    {
        $value = $this->headquarter_id;
        $disabledDays = MedicineDisabledDays::where('headquarter_id', $value)
            ->pluck('disabled_days')
            ->toArray();
        $occupiedDays = MedicineReserve::where('headquarter_id', $value)
            ->whereIn('status', [0, 1, 4])
            ->pluck('dateReserve')
            ->toArray();
        $disabledDaysArray = [];
        foreach ($disabledDays as $days) {
            $daysArray = array_map('trim', explode(',', $days));
            $disabledDaysArray = array_merge($disabledDaysArray, $daysArray);
        }
        if ($this->headquarter_id !== null) {
            $maxCitas = MedicineSchedule::with('scheduleHeadquarter')
                ->whereHas('scheduleHeadquarter', function ($max) {
                    $max->where('id', $this->headquarter_id);
                })
                ->value('max_schedules');
            $datesExceedingLimit = MedicineReserve::select('dateReserve')
                ->where('headquarter_id', $this->headquarter_id)
                ->whereIn('status', [0, 1, 4])
                ->groupBy('dateReserve')
                ->havingRaw('COUNT(*) >= ?', [$maxCitas])
                ->pluck('dateReserve')
                ->toArray();
            $datesExceedingLimit;
            $occupiedDays = array_filter($occupiedDays, function ($day) use ($datesExceedingLimit) {
                return in_array($day, $datesExceedingLimit);
            });
            $occupiedDays;
            $disabledDaysArray = array_merge($disabledDaysArray, $occupiedDays);
        }

        $this->disabledDaysFilter = $disabledDaysArray;
        $this->dispatchBrowserEvent('headquartersUpdated', [
            'disabledDaysFilter' => $disabledDaysArray
        ]);
    }
    public function valores($cheduleId)
    {

        $this->scheduleId = $cheduleId;
        $medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'medicineReserveHeadquarter'])
            ->where('id', $this->scheduleId)->get();
        $this->name = $medicineReserves[0]->medicineReserveMedicine->medicineUser->name . ' ' . $medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant[0]->apParental . ' ' . $medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant[0]->apMaternal;
        $this->type = $medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->name;
        $this->id_appoint = $medicineReserves[0]->id;

        if ($medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->id == 1) {
            $this->class = $medicineReserves[0]->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name;
            $this->typLicense = $medicineReserves[0]->medicineReserveMedicine->medicineInitial[0]->medicineInitialClasificationClass->name;
        } else if ($medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->id == 2) {
            $this->class = $medicineReserves[0]->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name;
            $this->typLicense = $medicineReserves[0]->medicineReserveMedicine->medicineRenovation[0]->renovationClasificationClass->name;
        }
        $this->headquarter_id = $medicineReserves[0]->medicineReserveHeadquarter->id;
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

        $this->sede = $medicineReserves[0]->medicineReserveHeadquarter->name_headquarter;
    }
    public function updatedToUserHeadquarters($value)
    {
        $this->scheduleMedicines = MedicineSchedule::with('scheduleHeadquarter')
            ->whereHas('scheduleHeadquarter', function ($max) use ($value) {
                $max->where('user_id', $value);
            })->where('status', 0)->get();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function reschedules()
    {

        //ASISTIÓ
        $this->validate();
        if ($this->selectedOption == 1) {

            $attendeReserve = MedicineReserve::find($this->scheduleId);
            $attendeReserve->update([
                'status' => $this->selectedOption,
            ]);
            $this->emit('attendeReserve');
            $accion = 'VALIDO CITA';
            //CANCELO EL ADMIN
        } elseif ($this->selectedOption == 2) {
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
            $accion = 'CANCELO CITA';
            //REAGENDO
        } elseif ($this->selectedOption == 4) {
            $accion = 'REAGENDO CITA';
            $observation = new MedicineObservation();
            $observation->medicine_reserve_id = $this->scheduleId;
            $observation->observation = $this->comment;
            $observation->status = 4;
            $observation->save();
            $citas = MedicineReserve::where('headquarter_id', $this->headquarter_id)
                ->where('dateReserve', $this->dateReserve)
                ->where(function ($query) {
                    $query->where('status', 0)
                        ->orWhere('status', 1)
                        ->orWhere('status', 4);
                })
                ->count();
            $maxCitas = MedicineSchedule::with('scheduleHeadquarter')
                ->whereHas('scheduleHeadquarter', function ($max) {
                    $max->where('id', $this->headquarter_id);
                })->value('max_schedules');
            if ($citas >= $maxCitas) {
                $this->notification([
                    'title'       => 'CITA NO GENERADA!',
                    'description' => 'No hay citas disponibles para ese dia',
                    'icon'        => 'error'
                ]);
            } else {
                $cita = MedicineReserve::find($this->scheduleId);
                $cita->headquarter_id = $this->headquarter_id;
                $cita->dateReserve = $this->dateReserve;
                $cita->status = $this->selectedOption;
                $cita->save();
                $this->emit('reserveAppointment');
            }
        }
        //Historial de validar cita
        medicine_history_movements::create([
            'user_id' => Auth::user()->id,
            'action' => $accion,
            'process' => $this->name . ' FOLIO CITA:' . $this->id_appoint
        ]);
        $this->closeModal();
    }
    public function saveActive()
    {
        $activeReserve = Medicine::find($this->medicineId);
        $activeReserve->update([
            'reference_number' => 'ACTIVE' . '-' . $this->medicineId,
        ]);
        $updateStatus = MedicineReserve::find($this->scheduleId);
        $updateStatus->update([
            'status' => '5',
        ]);
        $this->notification([
            'title'       => 'LLAVE DE PAGO LIBERADA!',
            'description' => 'La llave de pago se liberó.',
            'icon'        => 'info',
            'timeout' => '3100'
        ]);
        $this->closeModal();
        $this->emit('reserveAppointment');

        //Historial de liberar llave de pago
        medicine_history_movements::create([
            'user_id' => Auth::user()->id,
            'action' => "LIBERA LLAVE DE PAGO",
            'process' => $this->name . ' FOLIO CITA:' . $this->id_appoint
        ]);
        $this->closeModal();
    }
    public function messages()
    {
        return [
            'comment_cancelate.required_if' => 'Campo obligatorio',
            'dateReserve.required_if' => 'Campo obligatorio',
            'comment.required_if' => 'Campo obligatorio',
            'selectedOption.required' => 'Seleccione opción',
            'headquarter_id.required' => 'Seleccione opción',
            'medicine_schedule_id.required' => 'Seleccione opción'
        ];
    }
}
