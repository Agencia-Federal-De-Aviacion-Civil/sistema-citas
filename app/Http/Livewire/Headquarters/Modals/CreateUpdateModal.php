<?php

namespace App\Http\Livewire\Headquarters\Modals;

use App\Models\Catalogue\Headquarter;
use App\Models\System;
use App\Models\User;
use App\Models\Medicine\medicine_history_movements;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class CreateUpdateModal extends ModalComponent
{
    use Actions;
    public $id_user, $id_edit, $userId, $id_headquarter, $name, $direction, $passwordConfirmation, $password, $email, $system_id, $url;
    public $sedes;
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->id_user)],
            'direction' => 'required',
            'url' => 'required|url'
        ];
        if (Auth::user()->hasRole('super_admin')) {
            $rules['system_id'] = 'required';
        }
        $rules['password'] = $this->id_user ? '' : 'required|min:6|same:passwordConfirmation';
        return $rules;
    }
    public function mount($userId = null)
    {
        if (isset($userId)) {
            $this->userId = $userId;
            $this->sedes = Headquarter::with('headquarterUser')->where('user_id', $userId)->get();
            $this->name = $this->sedes[0]->headquarterUser->name;
            $this->direction = $this->sedes[0]->direction;
            $this->email = $this->sedes[0]->headquarterUser->email;
            $this->url = $this->sedes[0]->url;
            $this->system_id = $this->sedes[0]->system_id;
            $this->id_user = $userId;
            $this->id_headquarter = $this->sedes[0]->id;
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
        $this->reset(['name', 'email', 'password', 'system_id', 'direction', 'url']);
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
        $accion="ACTUALIZA SEDE";
        $this->validate();
        $userData = [
            'name' => $this->name,
            'email' => $this->email,
        ];
        if (!$this->id_user) {
            $userData['password'] = Hash::make($this->password);
            $accion="CREA NUEVA SEDE";
        }
        $saveHeadrquearter = User::updateOrCreate(
            ['id' => $this->id_user],
            $userData
        )->assignRole('headquarters');
        if (Auth::user()->hasRole('super_admin')) {
            $saveHeadrquearter = Headquarter::updateOrCreate(
                ['id' => $this->id_headquarter],
                [
                    'user_id' => $saveHeadrquearter->id,
                    'system_id' => $this->system_id,
                    'direction' => $this->direction,
                    'url' => $this->url
                ]
            );
        } else {
            $saveHeadrquearter = Headquarter::updateOrCreate(
                ['id' => $this->id_headquarter],
                [
                    'user_id' => $saveHeadrquearter->id,
                    'system_id' => 1,
                    'direction' => $this->direction,
                    'url' => $this->url
                ]
            );
        }

        //Historial de guardar y editar Sedes
        medicine_history_movements::create([
            'user_id' => Auth::user()->id,
            'action' => $accion,
            'process' => $this->name.' '.' DIRECCIÓN:'.$this->direction.' URL:'.$this->url
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
        ];
    }
}
