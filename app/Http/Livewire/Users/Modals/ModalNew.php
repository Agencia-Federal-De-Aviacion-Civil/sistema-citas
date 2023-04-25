<?php

namespace App\Http\Livewire\Users\Modals;

use App\Models\User;
use App\Models\UserParticipant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class ModalNew extends ModalComponent
{
    use Actions;
    use WithFileUploads;
    public $modal, $id_save, $name, $email, $apParental, $apMaternal, $password, $passwordConfirmation, $privileges, $privilegesId, $title;

    public function rules()
    {
        return [
            'name' => 'required',
            'apParental' => 'required',
            'apMaternal' => 'required',
            'privileges' => 'required',
            // 'email' => 'required|email|unique:users',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->privilegesId)],
            'password' => 'required|min:6|same:passwordConfirmation'
        ];
    }
    public function mount($privilegesId)
    {
        $this->privilegesId = $privilegesId;
        $this->valores($privilegesId);
    }

    public function render()
    {
        return view('livewire.users.modals.modal-new');
    }

    public function clean()
    {
        $this->reset(['name', 'email', 'password','apParental','apMaternal']);
    }
    public function valores($privilegesId)
    {

        $this->privilegesId = $privilegesId;

        if ($this->privilegesId != 0) {
            $userPrivileges = User::with('roles','UserParticipant')->where('id', $this->privilegesId)->get();
            $this->id_save = $userPrivileges[0]->id;
            $this->name = $userPrivileges[0]->name;
            $this->apParental = $userPrivileges[0]->UserParticipant[0]->apParental;
            $this->apMaternal = $userPrivileges[0]->UserParticipant[0]->apMaternal;
            $this->email = $userPrivileges[0]->email;
            $this->privileges = $userPrivileges[0]->roles[0]->name;
            $this->title = 'EDITAR USUARIO';
        } else {
            $this->title = 'AGREGAR USUARIO';
        }
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function save()
    {
        $this->validate();
        $privilegesUser = User::updateOrCreate(
            ['id' => $this->id_save],
            [
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]
        )->assignRole($this->privileges);
                
        $user_participants = new UserParticipant();
        $user_participants->user_id = $privilegesUser->id;
        $user_participants->apParental = $this->apParental;
        $user_participants->apMaternal = $this->apMaternal;
        $user_participants->genre = 0;
        $user_participants->birth = 0;
        $user_participants->age = 0;
        $user_participants->street = 0;
        $user_participants->nInterior = 0;
        $user_participants->nExterior = 0;
        $user_participants->suburb = 0;
        $user_participants->postalCode = 0;
        $user_participants->federalEntity = 0;
        $user_participants->delegation = 0;
        $user_participants->mobilePhone = 0;
        $user_participants->officePhone = 0;
        $user_participants->extension = 0;
        $user_participants->curp = 0;
        $user_participants->save();
        
        $this->emit('privilegesUser');
        $this->reset([]);
        $this->notification([
            'title'       => 'USUARIO AGREGADO CON EXITO',
            'icon'        => 'success',
            'timeout' => '3100'
        ]);
        $this->emit('privilegesUser');
        $this->closeModal();
    }
    public function messages()
    {
        return [
            'name.required' => 'Campo obligatorio',
            'email.required' => 'Campo obligatorio',
            'email.email' => 'No valido',
            'email.unique' => 'El correo electrónico registrado ya existe',
            'apParental.required' => 'Campo obligatorio',
            'apMaternal.required' => 'Campo obligatorio',
            'privileges.required' => 'Seleccione rol',
            'password.required' => 'Campo obligatorio',
            'password.min' => 'Minímo 8 carácteres',
            'password.same' => 'Las contraseñas no coinciden',
        ];
    }
}
