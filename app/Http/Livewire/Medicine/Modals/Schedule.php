<?php

namespace App\Http\Livewire\Medicine\Modals;

use App\Models\Catalogue\Headquarter;
use App\Models\Medicine\Medicine;
use App\Models\Medicine\MedicineDisabledDays;
use App\Models\Medicine\MedicineObservation;
use App\Models\Medicine\MedicineReserve;
use App\Models\Medicine\MedicineSchedule;
use App\Models\Medicine\medicine_history_movements;
use App\Models\Medicine\MedicineReservesExtension;
use App\Models\Observation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Schedule extends ModalComponent
{
    use Actions;
    use WithFileUploads;
    public $id_appoint, $id_medicine_observation, $scheduleId, $status, $medicineReserves, $name, $type, $class, $typLicense, $sede, $dateReserve, $date, $time, $scheduleMedicines, $sedes,
        $headquarter_id, $medicine_schedule_id, $selectedOption, $observation_reschedule, $observation_cancelate, $hoursReserve, $observation, $medicineId, $accion,
        $disabledDaysFilter, $days, $is_external,$medicineRextension,$typextension,$classxtension,$typLicensextension;

    public function rules()
    {
        $rules = [
            'observation' => 'required_if:selectedOption,2,4,7,3',
            'headquarter_id' => 'required_if:selectedOption,4,10|required_if:status,6',
            'medicine_schedule_id' => 'required_if:selectedOption,4,10|required_if:status,6',
            'dateReserve' => 'required_if:selectedOption,4,10|required_if:status,6'
        ];
        $rules['selectedOption'] = 'required_unless:status,6';
        return $rules;
    }

    public function mount($scheduleId = null, $medicineId)
    {
        $this->medicineId = $medicineId;
        $this->selectedOption = '';
        if (isset($scheduleId)) {
            $this->scheduleId = $scheduleId;
            $this->scheduleMedicines = collect();
            $this->sedes = Headquarter::where('system_id', 1)->where('status', false)->get();
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
            } else if ($medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->id == 3) {
                if ($medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->type_exam_id == 1) {
                    $this->class = $medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineInitial[0]->revaluationInitialTypeClass->name;
                    $this->typLicense = $medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineInitial[0]->revaluationInitialClasificationClass->name;
                } else if ($medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->type_exam_id == 2) {
                    $this->class = $medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineRenovation[0]->revaluationRenovationTypeClass->name;
                    $this->typLicense = $medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineRenovation[0]->revaluationRenovationClasificationClass->name;
                }
            } else if ($medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->id == 4) {
                $this->class = $medicineReserves[0]->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name;
                $this->typLicense = $medicineReserves[0]->medicineReserveMedicine->medicineRenovation[0]->renovationClasificationClass->name;
            }
            $this->id_medicine_observation = $medicineReserves[0]->reserveObserv[0]->id ?? null;
            $this->observation = $medicineReserves[0]->reserveObserv[0]->observation ?? null;
            $this->status = $medicineReserves[0]->status;
            $this->sede = $medicineReserves[0]->medicineReserveHeadquarter->name_headquarter ?? null;
            $this->hoursReserve = $medicineReserves[0]->reserveSchedule->time_start ?? null;
            $this->dateReserve = $medicineReserves[0]->dateReserve;
            $fecha = Carbon::now()->timezone('America/Mexico_City');
            $fechaEspera = new Carbon($medicineReserves[0]->dateReserve, 'America/Mexico_City');
            $this->days = $fecha->diffInDays($fechaEspera);
            $this->is_external = $medicineReserves[0]->is_external;

            if (Auth::user()->can('user.see.schedule.table')) {
                $this->sedes = Headquarter::where('system_id', 1)->where('id', $medicineReserves[0]->headquarter_id)->get();
                $this->selectedOption = '';
            }
            $this->medicineRextension = MedicineReservesExtension::with(['extensionTypeClass','extensionClasificationClass'])->where('medicine_reserve_id',$this->id_appoint)->get();
            if(isset($this->medicineRextension[0]->id)){
                $this->typextension = $this->medicineRextension[0]->extensionTypeClass->typeClassTypeExam->name;
                $this->classxtension = $this->medicineRextension[0]->extensionTypeClass->name;
                $this->typLicensextension = $this->medicineRextension[0]->extensionClasificationClass->name;
            }
        } else {
            $this->scheduleId = null;
        }
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
            ->whereIn('status', [0, 1, 4,10])
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
                ->whereIn('status', [0, 1, 4,10])
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
            'disabledDaysFilter' => $disabledDaysArray,
        ]);
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
            $medicineObservation = MedicineObservation::updateOrCreate(
                ['id' => $this->id_medicine_observation],
                [
                    'medicine_reserve_id' => $this->scheduleId,
                    'observation' => $this->observation,
                    'status' => 2,
                ]
            );
            $cancelReserve = MedicineReserve::find($this->scheduleId);
            $cancelReserve->update([
                'status' => $this->selectedOption,
            ]);
            $this->emit('cancelReserve');
            $accion = 'CANCELO CITA';
            //REAGENDO
        } elseif ($this->selectedOption == 3) {
            $medicineObservation = MedicineObservation::updateOrCreate(
                ['id' => $this->id_medicine_observation],
                [
                    'medicine_reserve_id' => $this->scheduleId,
                    'observation' => $this->observation,
                    'status' => 3,
                ]
            );
            $cancelReserve = MedicineReserve::find($this->scheduleId);
            $cancelReserve->update([
                'status' => $this->selectedOption,
            ]);
            $this->emit('cancelReserve');
            $accion = 'CANCELO CITA';
            //REAGENDO
        } elseif ($this->selectedOption == 4) {
            $accion = 'REAGENDO CITA';
            $medicineObservation = MedicineObservation::updateOrCreate(
                ['id' => $this->id_medicine_observation],
                [
                    'medicine_reserve_id' => $this->scheduleId,
                    'observation' => $this->observation,
                    'status' => 4,
                ]
            );
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
                    'title' => 'CITA NO GENERADA!',
                    'description' => 'No hay citas disponibles para ese dia',
                    'icon' => 'error',
                ]);
            } else {
                $cita = MedicineReserve::find($this->scheduleId);
                $cita->headquarter_id = $this->headquarter_id;
                $cita->dateReserve = $this->dateReserve;
                $cita->medicine_schedule_id = $this->medicine_schedule_id;
                $cita->status = $this->selectedOption ?: 0;
                $cita->save();
                $this->emit('reserveAppointment');
            }
        } elseif ($this->selectedOption == 10) {
            $accion = 'REAGENDO CITA';
            $medicineObservation = MedicineObservation::updateOrCreate(
                ['id' => $this->id_medicine_observation],
                [
                    'medicine_reserve_id' => $this->scheduleId,
                    'observation' => $this->observation,
                    'status' => 10,
                ]
            );
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
                    'title' => 'CITA NO GENERADA!',
                    'description' => 'No hay citas disponibles para ese dia',
                    'icon' => 'error',
                ]);
            } else {
                $cita = MedicineReserve::find($this->scheduleId);
                $cita->headquarter_id = $this->headquarter_id;
                $cita->dateReserve = $this->dateReserve;
                $cita->medicine_schedule_id = $this->medicine_schedule_id;
                $cita->status = $this->selectedOption ?: 0;
                $cita->save();
                $this->emit('reserveAppointment');
            }
        } elseif ($this->selectedOption == 7) {

            $medicineObservation = MedicineObservation::updateOrCreate(
                ['id' => $this->id_medicine_observation],
                [
                    'medicine_reserve_id' => $this->scheduleId,
                    'observation' => $this->observation,
                    'status' => 7,
                ]
            );
            $postponeReserve = MedicineReserve::find($this->scheduleId);
            $postponeReserve->update([
                'status' => $this->selectedOption,
            ]);
            $this->emit('postponeReserve');
            $accion = 'APLAZAR CITA';
        } else {
            $citas = MedicineReserve::where('headquarter_id', $this->headquarter_id)
                ->where('dateReserve', $this->dateReserve)
                ->where(function ($query) {
                    $query->where('status', 0);
                })
                ->count();
            $maxCitas = MedicineSchedule::with('scheduleHeadquarter')
                ->whereHas('scheduleHeadquarter', function ($max) {
                    $max->where('id', $this->headquarter_id);
                })->value('max_schedules');
            if ($citas >= $maxCitas) {
                $this->notification([
                    'title' => 'CITA NO GENERADA!',
                    'description' => 'No hay citas disponibles para ese dia',
                    'icon' => 'error',
                ]);
            } else {
                $cita = MedicineReserve::find($this->scheduleId);
                $cita->headquarter_id = $this->headquarter_id;
                $cita->dateReserve = $this->dateReserve;
                $cita->medicine_schedule_id = $this->medicine_schedule_id;
                $cita->status = $this->selectedOption ?: 0;
                $cita->save();
                $this->emit('reserveAppointment');
                $accion = 'COMPLETÓ DATOS';
            }
        }
        medicine_history_movements::create([
            'user_id' => Auth::user()->id,
            'action' => $accion ?: 'COMPLETÓ DATOS',
            'process' => $this->name . ' FOLIO CITA:' . $this->id_appoint,
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
            'title' => 'LLAVE DE PAGO LIBERADA!',
            'description' => 'La llave de pago se liberó.',
            'icon' => 'info',
            'timeout' => '3100',
        ]);
        $this->closeModal();
        $this->emit('reserveAppointment');

        //Historial de liberar llave de pago
        medicine_history_movements::create([
            'user_id' => Auth::user()->id,
            'action' => "LIBERA LLAVE DE PAGO",
            'process' => $this->name . ' FOLIO CITA:' . $this->id_appoint,
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
            'medicine_schedule_id.required' => 'Seleccione opción',
            'selectedOption.required_unless' => 'El campo de opción seleccionado es obligatorio a menos que el estado esté en 6.'
        ];
    }
}
