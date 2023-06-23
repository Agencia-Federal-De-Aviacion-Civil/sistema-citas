<?php

namespace App\Http\Livewire\Headquarters\Modals;

use App\Models\Catalogue\Headquarter;
use App\Models\Catalogue\TypeExam;
use App\Models\System;
use App\Models\User;
use App\Models\Medicine\medicine_history_movements;
use App\Models\Medicine\MedicineSchedule;
use App\Models\Medicine\MedicineScheduleException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class CreateUpdateModal extends ModalComponent
{
    use Actions;
    public $id_user, $id_edit, $id_schedule, $id_exception, $userId, $id_headquarter, $time_start, $type_exam_id,
        $max_schedules_exception, $max_schedules, $name, $direction, $passwordConfirmation, $password, $email, $system_id, $url, $status;
    public $sedes, $typeExams;
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->id_user)],
            'direction' => 'required',
            'url' => 'required|url',
            'status' => 'required',
            'time_start' => 'required',
            'max_schedules' => 'required',
            'type_exam_id' => '',
            'max_schedules_exception' => ''
        ];
        if (Auth::user()->hasRole('super_admin')) {
            $rules['system_id'] = 'required';
        }
        $rules['password'] = $this->id_user ? '' : 'required|min:6|same:passwordConfirmation';
        return $rules;
    }
    public function mount($userId = null)
    {
        $this->typeExams = TypeExam::all();
        if (isset($userId)) {
            $this->userId = $userId;
            $this->sedes = Headquarter::with(['headquarterUser', 'headquarterSchedule'])->where('user_id', $userId)->get();
            $this->name = $this->sedes[0]->headquarterUser->name;
            $this->direction = $this->sedes[0]->direction;
            $this->email = $this->sedes[0]->headquarterUser->email;
            $this->url = $this->sedes[0]->url;
            $this->system_id = $this->sedes[0]->system_id;
            $this->status = $this->sedes[0]->status;
            $this->time_start = $this->sedes[0]->headquarterSchedule->time_start;
            $this->max_schedules = $this->sedes[0]->headquarterSchedule->max_schedules;
            // $this->max_schedules_exception = $this->sedes[0]->headquarterSchedule->schedulesMedicineException[0]->max_schedules_exception;
            // $this->type_exam_id = $this->sedes[0]->headquarterSchedule->schedulesMedicineException[0]->type_exam_id;
            $this->id_user = $userId;
            $this->id_headquarter = $this->sedes[0]->id;
            $this->id_schedule = $this->sedes[0]->headquarterSchedule->id;
            $this->id_exception = $this->sedes[0]->headquarterSchedule->schedulesMedicineException[0]->id;
        } else {
            $this->userId = null; // o cualquier otro valor predeterminado que desees
        }
    }
    public function render()
    {
        $qSystems = System::all();
        $headquarters = Headquarter::with('headquarterUser')->get();
        return view('livewire.headquarters.modals.create-update-modal', compact('qSystems', 'headquarters'));
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function clean()
    {
        $this->reset(['name', 'email', 'password', 'system_id', 'direction', 'url', 'status']);
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
        $userData = [
            'name' => $this->name,
            'email' => $this->email,
        ];
        if (!$this->id_user) {
            $userData['password'] = Hash::make($this->password);
            $accion = "CREA NUEVA SEDE";
        }
        $saveHeadrquearter = User::updateOrCreate(
            ['id' => $this->id_user],
            $userData
        )->assignRole('headquarters');
        if (Auth::user()->hasRole('super_admin')) {
            $medicineControl = MedicineSchedule::updateOrCreate(
                ['id' => $this->id_schedule],
                [
                    'user_id' => $saveHeadrquearter->id,
                    'time_start' => $this->time_start,
                    'max_schedules' => $this->max_schedules,
                ]
            );
            $medicineException = MedicineScheduleException::updateOrCreate(
                [
                    'id' => $this->id_exception
                ],
                [
                    'medicine_schedule_id' => $medicineControl->id,
                    'type_exam_id' => $this->type_exam_id,
                    'max_schedules_exception' => $this->max_schedules_exception
                ]
            );
            $saveHeadrquearter = Headquarter::updateOrCreate(
                ['id' => $this->id_headquarter],
                [
                    'user_id' => $saveHeadrquearter->id,
                    'system_id' => $this->system_id,
                    'medicine_schedule_id' => $medicineControl->id,
                    'direction' => $this->direction,
                    'url' => $this->url,
                    'status' => $this->status
                ]
            );
        } else {
            $saveHeadrquearter = Headquarter::updateOrCreate(
                ['id' => $this->id_headquarter],
                [
                    'user_id' => $saveHeadrquearter->id,
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
            'process' => $this->name . ' ' . ' DIRECCIÓN:' . $this->direction . ' URL:' . $this->url
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
    public function messages()
    {
        return [
            'system_id.required' => 'Campo obligatorio',
            'name.required' => 'Campo obligatorio',
            'email.required' => 'Campo obligatorio',
            'email.email' => 'Correo no valido',
            'email.unique' => 'Correo electrónico ya existe',
            'password.required' => 'Campo obligatorio',
            'password.min' => 'Mínimo 6 carácteres',
            'password.same' => 'La contraseña no coíncide',
            'direction.required' => 'Campo obligatorio',
            'url.required' => 'Campo obligatorio',
            'url.url' => 'Dirección no valida',
            'status.required' => 'Campo obligatorio',
        ];
    }
}
