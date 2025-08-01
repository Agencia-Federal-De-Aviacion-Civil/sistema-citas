<?php

namespace App\Http\Livewire\Medicine\Modals;

use App\Models\Catalogue\Headquarter;
use App\Models\Catalogue\LogsApi;
use App\Models\Document;
use App\Models\Medicine\Medicine;
use App\Models\Medicine\MedicineDisabledDays;
use App\Models\Medicine\MedicineObservation;
use App\Models\Medicine\MedicineReserve;
use App\Models\Medicine\MedicineSchedule;
use App\Models\Medicine\medicine_history_movements;
use App\Models\Medicine\MedicineReservesExtension;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use LivewireUI\Modal\ModalComponent;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Schedule extends ModalComponent
{
    use Actions;
    use WithFileUploads;
    public $id_appoint, $id_medicine_observation, $scheduleId, $status, $medicineReserves, $name, $type, $class, $typLicense, $sede, $dateReserve, $date, $time, $scheduleMedicines, $sedes,
        $headquarter_id, $medicine_schedule_id, $selectedOption, $observation_reschedule, $observation_cancelate, $hoursReserve, $observation, $medicineId, $accion,
        $disabledDaysFilter, $days, $is_external, $medicineRextension, $typextension, $classxtension, $typLicensextension;
    public $reference_number, $pay_date, $document_pay, $januaryAppointment, $dateMin, $dateMax;
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
            $this->januaryAppointment = $medicineReserves[0]->medicineReserveMedicine;
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
            } else if ($medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->id == 5) {
                $this->class = $medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineRenovation[0]->revaluationRenovationTypeClass->name;
                $this->typLicense = $medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineRenovation[0]->revaluationRenovationClasificationClass->name;
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
            $this->medicineRextension = MedicineReservesExtension::with(['extensionTypeClass', 'extensionClasificationClass'])->where('medicine_reserve_id', $this->id_appoint)->get();
            if (isset($this->medicineRextension[0]->id)) {
                $this->typextension = isset($this->medicineRextension[0]->extensionTypeClass->typeClassTypeExam->name) ? $this->medicineRextension[0]->extensionTypeClass->typeClassTypeExam->name : 'SIN DATOS';
                $this->classxtension = isset($this->medicineRextension[0]->extensionTypeClass->name) ? $this->medicineRextension[0]->extensionTypeClass->name : 'SIN DATOS';
                $this->typLicensextension = isset($this->medicineRextension[0]->extensionClasificationClass->name) ? $this->medicineRextension[0]->extensionClasificationClass->name : 'SIN DATOS';
                $this->status = isset($this->medicineRextension[0]->status) ? $this->medicineRextension[0]->status : 'SIN DATOS';
            }
        } else {
            $this->scheduleId = null;
        }
    }
    public function rules()
    {
        $rules = [
            'observation' => 'required_if:selectedOption,2,4,7,3',
            'headquarter_id' => 'required_if:selectedOption,4,10|required_if:status,6',
            'medicine_schedule_id' => 'required_if:selectedOption,4,10|required_if:status,6',
            'dateReserve' => 'required_if:selectedOption,4,10|required_if:status,6',
        ];
        $rules['selectedOption'] = 'required_unless:status,6';
        return $rules;
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
            ->whereIn('status', [0, 1, 8, 9, 4, 10])
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
                ->whereIn('status', [0, 1, 4, 10, 6, 7, 8, 9])
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
        // $this->dispatchBrowserEvent('headquartersUpdated', [
        //     'disabledDaysFilter' => $disabledDaysArray,
        // ]);

        // TODO TEMPORALY
        // if ($this->is_external === 0) {
        //     $dateMin = Carbon::now()->format('Y-m-d');;
        //     $dateMax = Carbon::create(2025, 1, 31)->format('Y-m-d');
        // } elseif ($this->is_external === 1) {
        //     $dateMin = Carbon::now()->format('Y-m-d');
        //     $dateMax = Carbon::create(2025, 12, 31)->format('Y-m-d');
        // }
        $this->dispatchBrowserEvent('headquartersUpdated', [
            'disabledDaysFilter' => $disabledDaysArray,
            // 'dateMin' => $dateMin,
            // 'dateMax' => $dateMax
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
        $this->validate();
        // // TODO IMPLEMENT APPOITNMENT JANUARY
        // if (!empty($this->januaryAppointment->document_id)) {
        //     $completedJanuaryReserve = Medicine::find($this->medicineId);
        //     $completedJanuaryReserve->update([
        //         'reference_number' => $this->reference_number ?? 'NO APLICA',
        //         'pay_date' => $this->pay_date ?? null,
        //     ]);
        //     $updateJanuaryDocument = Document::find($completedJanuaryReserve->document_id);
        //     $extension = $this->document_pay->getClientOriginalExtension();
        //     $fileName = $this->reference_number . '-' . $this->pay_date . '.' . $extension;
        //     $updateJanuaryDocument->update([
        //         'name_document' => $this->document_pay->storeAs('documentos/medicina', $fileName, 'public'),
        //     ]);
        //     // TODO END
        // }
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
            $updateReservePay = Medicine::find($cancelReserve->medicine_id);
            $updateReservePay->update([
                'reference_number' => "CANCELADO" . '-' . $cancelReserve->medicine_id
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
            $updateReservePay = Medicine::find($cancelReserve->medicine_id);
            $updateReservePay->update([
                'reference_number' => "CANCELADO" . '-' . $cancelReserve->medicine_id
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
        $this->confirmStatusApi();
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

        $this->scheduleId;
        $this->selectedOption = 5;
        $this->confirmStatusApi();
    }

    public function confirmStatusApi()
    {

        $cancelActive = ($this->selectedOption == 5) ? 'ACTIVE' : (($this->selectedOption == 2 || $this->selectedOption == 3) ? 'CANCEL' : NULL);
        $status_id =
            [
                '1' => 1, //PENDIENTE
                '2' => 6, //CANCELAR CITA
                '3' => 8, //CANCELA USUARIO
                '4' => 4, //REAGENDAR CITA
                '5' => 6, //LIBERADA
                '6' => 1,   //IMCOMPLETA
                '7' => 5, //APLAZAR CITA
                '8' => 2,
                '9' => 3,
                '10' => 7 //REAGENDADO USUARIO
            ][$this->selectedOption];

        if ($status_id == 4 || $status_id == 5 || $status_id == 7) {
            $status =
                [
                    'id' => $this->scheduleId,
                    'status_id' => $status_id,
                    'observation' => $this->observation,
                    'headquarter_id' => $this->headquarter_id,
                    'dateReserve' => $this->dateReserve,
                ];
        }
        if ($status_id == 8 || $status_id == 6 || $status_id == 1) {
            $status =
                [
                    'id' => $this->scheduleId,
                    'status_id' => $status_id,
                    'observation' => $this->observation,
                    'cancelActive' => $cancelActive
                ];
        }

        if (checkdnsrr('crp.sct.gob.mx', 'A')) {
            // dump($status);
            $endpoint = env('SIMA_API_STATUS', null);
            $response = Http::withHeaders([
                'AuthorizationSima' => '8X4Oeq4g3puzL77UVVu1ZfNoSGZ2R5tgdZgcuLMfpRDuHMQuvyemKgftajZjGkQX',
                'Accept' => 'application/json'
            ])->connectTimeout(30)->put('https://siafac.afac.gob.mx/statusCita?', $status);
            // http://siafac.afac.gob.mx/statusCita?
            if ($response->successful()) {
                $statesSuccess = $response->json()['data'];
            } elseif ($response->successful() && $response->json()['data'] === 'NO EXITOSO') {
                $this->clean();
                $this->notification()->send([
                    'title'       => 'No se realizo registro!',
                    'description' => 'Status no registrada.',
                    'icon'        => 'error',
                    'timeout' => '3100'
                ]);
            } else {
                $error = $response->json()['message'];
                $this->LogsApi($curp_logs = Auth::user()->UserParticipant->first()->curp, $type = 'AGENDAR CITA', $register = $error, $description = 'ERROR AL AGENDAR REGISTRO DE CITA');
                $this->notification()->send([
                    'icon' => 'info',
                    'title' => 'AVISO!',
                    'description' => 'ERROR',
                    'timeout' => '3100'
                ]);
            }
        } else {
            $this->notification()->send([
                'icon' => 'info',
                'title' => 'Sin conexión!',
                'description' => 'No hay conexión, vuelve a intentarlo.',
                'timeout' => '3100'
            ]);
            $this->LogsApi($curp_logs = Auth::user()->UserParticipant->first()->curp, $type = 'AGENDAR CITA', $register = 'SIN CONEXION', $description = 'No hay conexión, vuelve a intentarlo');
        }
    }
    public function LogsApi($curp_logs, $type, $register, $description)
    {
        $url = url()->previous();
        $logs =  LogsApi::create([
            'curp_logs' => $curp_logs,
            'url' => $url,
            'type' => $type,
            'register' => $register,
            'description' => $description
        ]);
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
