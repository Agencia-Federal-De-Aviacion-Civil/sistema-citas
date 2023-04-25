<?php

namespace App\Http\Livewire\Headquarters\Modals;

use App\Models\Catalogue\Headquarter;
use App\Models\System;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class NewModal extends ModalComponent
{
    use Actions;
    public $id_save, $name, $direction, $passwordConfirmation, $password, $email, $system_id, $url;
    public function rules()
    {
        return [
            'system_id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|same:passwordConfirmation',
            'direction' => 'required',
            'url' => 'required|url'
        ];
    }
    public function render()
    {
        $qSystems = System::all();
        $headquarters = Headquarter::with('headquarterUser')->get();
        return view('livewire.headquarters.modals.new-modal', compact('qSystems', 'headquarters'));
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function clean()
    {
        $this->reset(['name', 'email', 'password', 'system_id', 'direction', 'url']);
    }
    public function save()
    {
        $this->validate();
        $saveHeadrquearter = User::updateOrCreate(
            ['id' => $this->id_save],
            [
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]
        )->assignRole('headquarters');
        $saveHeadrquearter = Headquarter::updateOrCreate(
            ['id' => $this->id_save],
            [
                'user_id' => $saveHeadrquearter->id,
                'system_id' => $this->system_id,
                'direction' => $this->direction,
                'url' => $this->url
            ]
        );
        $this->emit('saveHeadquarter');
        $this->clean();
        $this->closeModal();
        $this->notification([
            'title'       => 'Sede agrada con éxito',
            'icon'        => 'success',
            'timeout'=>'3100'
        ]);
    }
    public function messages()
    {
        return [
            'system_id.required' => 'Campo obligatorio',
            'name.required' => 'Campo obligatorio',
            'email.required' => 'Campo obligatorio',
            'email.email' => 'Correo no valido',
            'email.unique' => 'Correo ya existe',
            'password.required' => 'Campo obligatorio',
            'password.min' => 'Mínimo 6 carácteres',
            'password.same' => 'La contraseña no coíncide',
            'direction.required' => 'Campo obligatorio',
            'url.required' => 'Campo obligatorio',
            'url.url' => 'Dirección no valida',
        ];
    }
}
