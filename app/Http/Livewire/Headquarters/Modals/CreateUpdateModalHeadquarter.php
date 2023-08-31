<?php

namespace App\Http\Livewire\Headquarters\Modals;

use App\Models\Catalogue\Headquarter;
use App\Models\Catalogue\TypeExam;
use App\Models\System;
use App\Models\User;
use App\Models\Medicine\medicine_history_movements;
use App\Models\Medicine\MedicineSchedule;
use App\Models\Medicine\MedicineScheduleException;
use App\Models\Medicine\MedicineScheduleExceptionMaxException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class CreateUpdateModalHeadquarter extends ModalComponent
{
    use Actions;
    public $id_user, $id_edit, $id_schedule, $id_exception, $userId, $id_headquarter, $time_start, $type_exam_id,
        $max_schedules_exception, $max_schedules, $name_headquarter, $direction, $system_id, $url, $status;
    public $sedes, $typeExams, $questionException = '0', $schedulesExceptions;
    public function rules()
    {
        $rules = [
            'name_headquarter' => 'required',
            'direction' => 'required',
            'url' => 'required|url',
            'status' => 'required',
            'questionException' => 'required',
            'time_start' => 'required',
            'max_schedules' => 'required',
            'type_exam_id' => 'required_unless:questionException,0|unique:medicine_schedule_exceptions',
            'max_schedules_exception' => 'required_unless:questionException,0'
        ];
        if (Auth::user()->hasRole('super_admin')) {
            $rules['system_id'] = 'required';
        }
        return $rules;
    }
    public function mount($userId = null)
    {
        $this->typeExams = TypeExam::all();
        if (isset($userId)) {
            $this->userId = $userId;
            $this->sedes = Headquarter::with(['headquarterUserParticipant', 'headquarterSchedule'])->where('id', $userId)->get();
            $this->schedulesExceptions = $this->sedes[0]->headquarterSchedule->schedulesMedicineException;
            $this->name_headquarter = $this->sedes[0]->name_headquarter;
            $this->direction = $this->sedes[0]->direction;
            $this->url = $this->sedes[0]->url;
            $this->system_id = $this->sedes[0]->system_id;
            $this->status = $this->sedes[0]->status;
            $this->time_start = $this->sedes[0]->headquarterSchedule->time_start;
            $this->max_schedules = $this->sedes[0]->headquarterSchedule->max_schedules;
            // $this->max_schedules_exception = isset($this->sedes[0]->headquarterSchedule->schedulesMedicineException[0]->max_schedules_exception) ? $this->sedes[0]->headquarterSchedule->schedulesMedicineException[0]->max_schedules_exception : '';
            // $this->type_exam_id = isset($this->sedes[0]->headquarterSchedule->schedulesMedicineException[0]->type_exam_id) ? $this->sedes[0]->headquarterSchedule->schedulesMedicineException[0]->type_exam_id : '';
            $this->id_headquarter = $this->sedes[0]->id;
            $this->id_schedule = $this->sedes[0]->headquarterSchedule->id;
            // $this->id_exception = isset($this->sedes[0]->headquarterSchedule->schedulesMedicineException[0]->id) ? $this->sedes[0]->headquarterSchedule->schedulesMedicineException[0]->id : '';
        } else {
            $this->userId = null; // o cualquier otro valor predeterminado que desees
        }
    }
    public function render()
    {
        $qSystems = System::all();
        $headquarters = Headquarter::with('headquarterUserParticipant')->get();
        $medicineSchedulesExceptions = MedicineScheduleExceptionMaxException::with(
            'maxExceptionMedicineSchedule.medicineSchedules.scheduleHeadquarter'
        )
            ->whereHas('maxExceptionMedicineSchedule.medicineSchedules.scheduleHeadquarter', function ($q1) {
                $q1->where('id', $this->userId);
            })
            ->get();
        return view('livewire.headquarters.modals.create-update-modal-headquarter', compact('qSystems', 'headquarters', 'medicineSchedulesExceptions'));
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function clean()
    {
        $this->reset(['name_headquarter', 'system_id', 'direction', 'url', 'status']);
    }
    public static function closeModalOnEscape(): bool
    {
        return false;
    }
    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
    public function save()
    {
        $accion = "ACTUALIZA SEDE";
        $this->validate();
        if (Auth::user()->hasRole(['super_admin','super_admin_medicine'])) {
            $medicineControl = MedicineSchedule::updateOrCreate(
                ['id' => $this->id_schedule],
                [
                    'time_start' => $this->time_start,
                    'max_schedules' => $this->max_schedules,
                ]
            );
            if ($this->questionException == 1) {
                $typeExamsEachs = $this->type_exam_id;
                $medicineScheduleExceptionMax = MedicineScheduleExceptionMaxException::create([
                    'max_schedules_exception' => $this->max_schedules_exception
                ]);
                if (is_array($typeExamsEachs)) {
                    foreach ($typeExamsEachs as $typeExamsEach) {
                        MedicineScheduleException::create(
                            // [
                            //     'id' => $this->id_exception
                            // ],
                            [
                                'medicine_schedule_id' => $medicineControl->id,
                                'type_exam_id' => $typeExamsEach,
                                'schedule_exception_max_id' => $medicineScheduleExceptionMax->id
                            ]
                        );
                    }
                } else {
                    MedicineScheduleException::create(
                        // [
                        //     'id' => $this->id_exception
                        // ],
                        [
                            'medicine_schedule_id' => $medicineControl->id,
                            'type_exam_id' => $this->type_exam_id,
                            'schedule_exception_max_id' => $medicineScheduleExceptionMax->id
                        ]
                    );
                }
            }
            $saveHeadquarter = Headquarter::updateOrCreate(
                ['id' => $this->id_headquarter],
                [
                    'name_headquarter' => $this->name_headquarter,
                    'system_id' => $this->system_id,
                    'medicine_schedule_id' => $medicineControl->id,
                    'name_headquarter' => $this->name_headquarter,
                    'direction' => $this->direction,
                    'url' => $this->url,
                    'status' => $this->status
                ]
            );
        } else {
            $saveHeadquarter = Headquarter::updateOrCreate(
                ['id' => $this->id_headquarter],
                [
                    'system_id' => 1,
                    'direction' => $this->direction,
                    'url' => $this->url,
                    'status' => $this->status
                ]
            );
        }
        //Historial de guardar y editar Sedes
        medicine_history_movements::create([
            'user_id' => Auth::user()->id,
            'action' => $accion,
            'process' => $this->name_headquarter . ' ' . ' DIRECCIÓN:' . $this->direction . ' URL:' . $this->url.' CITAS POR DIA:'.$this->max_schedules
        ]);

        $this->emit('saveHeadquarter');
        $this->clean();
        $this->closeModal();
        $this->notification([
            'title'       => 'REGISTRO GUARDADO EXITOSAMENTE',
            'icon'        => 'success',
            'timeout' => '3100'
        ]);
    }
    public function delete($idFirst)
    {
        $deleteQuery = MedicineScheduleException::find($idFirst);
        if (MedicineScheduleException::count() <= 1) {
            $idDeleteException = $deleteQuery->schedule_exception_max_id;
            MedicineScheduleExceptionMaxException::find($idDeleteException)->delete();
            $deleteQuery->destroy($idFirst);
        } else {
            $deleteQuery->destroy($idFirst);
        }
    }
    public function messages()
    {
        return [
            'system_id.required' => 'Campo obligatorio',
            'direction.required' => 'Campo obligatorio',
            'max_schedules_exception.required_unless' => 'Campo obligatorio',
            'type_exam_id.unique' => 'Algunas de las opciones ya se han agregado',
            'url.required' => 'Campo obligatorio',
            'url.url' => 'Dirección no valida',
            'status.required' => 'Campo obligatorio',
        ];
    }
}
