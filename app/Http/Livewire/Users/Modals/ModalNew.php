<?php

namespace App\Http\Livewire\Users\Modals;

use App\Models\User;
use App\Models\UserParticipant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;
use WireUi\Traits\Actions;

class ModalNew extends ModalComponent
{
    use Actions;
    use WithFileUploads;
    public $roles, $modal, $id_save, $id_update, $name, $email, $apParental, $apMaternal, $state_id, $municipal_id, $password, $passwordConfirmation, $privileges, $privilegesId, $title,
        $genre, $birth, $age, $street, $nInterior, $nExterior, $suburb, $postalCode, $federalEntity, $delegation, $mobilePhone, $officePhone, $extension, $curp;
    public function rules()
    {
        $rules =  [
            'name' => 'required',
            'apParental' => 'required',
            'apMaternal' => 'required',
            'privileges' => 'required',
            // 'email' => 'required|email|unique:users',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->privilegesId)],
            'password' => 'required|min:6|same:passwordConfirmation'
        ];
        $rules['password'] = $this->privilegesId ? '' : 'required|min:6|same:passwordConfirmation';
        return $rules;
    }
    public function mount($privilegesId)
    {
        $this->privilegesId = $privilegesId;
        $this->valores($privilegesId);
        $this->roles = Role::all()->where('id', '<>', 5);
    }
    public function render()
    {
        return view('livewire.users.modals.modal-new');
    }

    public function clean()
    {
        $this->reset(['name', 'email', 'password', 'apParental', 'apMaternal']);
    }
    public function valores($privilegesId)
    {
        $this->privilegesId = $privilegesId;
        if ($this->privilegesId != 0) {
            $userPrivileges = User::with('roles', 'UserParticipant')->where('id', $this->privilegesId)->get();
            $this->id_save = $userPrivileges[0]->id;
            $this->name = $userPrivileges[0]->name;
            $this->apParental = $userPrivileges[0]->UserParticipant[0]->apParental;
            $this->apMaternal = $userPrivileges[0]->UserParticipant[0]->apMaternal;
            $this->state_id = $userPrivileges[0]->UserParticipant[0]->state_id;
            $this->municipal_id = $userPrivileges[0]->UserParticipant[0]->municipal_id;
            $this->email = $userPrivileges[0]->email;
            $this->privileges = $userPrivileges[0]->roles[0]->name;
            $this->title = 'EDITAR USUARIO';
            $this->id_update = $userPrivileges[0]->UserParticipant[0]->id;
            $this->genre = $userPrivileges[0]->UserParticipant[0]->genre;
            $this->birth = $userPrivileges[0]->UserParticipant[0]->birth;
            $this->age = $userPrivileges[0]->UserParticipant[0]->age;
            $this->street = $userPrivileges[0]->UserParticipant[0]->street;
            $this->nInterior = $userPrivileges[0]->UserParticipant[0]->nInterior;
            $this->nExterior = $userPrivileges[0]->UserParticipant[0]->nExterior;
            $this->suburb = $userPrivileges[0]->UserParticipant[0]->suburb;
            $this->postalCode = $userPrivileges[0]->UserParticipant[0]->postalCode;
            $this->federalEntity = $userPrivileges[0]->UserParticipant[0]->federalEntity;
            $this->delegation = $userPrivileges[0]->UserParticipant[0]->delegation;
            $this->mobilePhone = $userPrivileges[0]->UserParticipant[0]->mobilePhone;
            $this->officePhone = $userPrivileges[0]->UserParticipant[0]->officePhone;
            $this->extension = $userPrivileges[0]->UserParticipant[0]->extension;
            $this->curp = $userPrivileges[0]->UserParticipant[0]->curp;
        } else {
            $this->title = 'AGREGAR USUARIO';
            $this->state_id = 1;
            $this->municipal_id = 1;
            $this->genre = 0;
            $this->birth = 0;
            $this->age = 0;
            $this->street = 0;
            $this->nInterior = 0;
            $this->nExterior = 0;
            $this->suburb = 0;
            $this->postalCode = 0;
            $this->federalEntity = 0;
            $this->delegation = 0;
            $this->mobilePhone = 0;
            $this->officePhone = 0;
            $this->extension = 0;
            $this->curp = 0;
        }
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function save()
    {
        // dd($this->id_save);
        $this->validate();
        $userData = [
            'name' => $this->name,
            'email' => $this->email,
        ];
        if (!$this->privilegesId) {
            $userData['password'] = Hash::make($this->password);
        }
        $privilegesUser = User::updateOrCreate(
            ['id' => $this->id_save],
            $userData,
        )->syncRoles($this->privileges);

        $user_participants = UserParticipant::updateOrCreate(
            ['id' => $this->id_update],
            [
                'user_id' => $privilegesUser->id,
                'apParental' => $this->apParental,
                'apMaternal' => $this->apMaternal,
                'genre' => $this->genre,
                'birth' => $this->birth,
                'state_id' => $this->state_id,
                'municipal_id' => $this->municipal_id,
                'age' => $this->age,
                'street' => $this->street,
                'nInterior' => $this->nInterior,
                'nExterior' => $this->nExterior,
                'suburb' => $this->suburb,
                'postalCode' => $this->postalCode,
                'federalEntity' => $this->federalEntity,
                'delegation' => $this->delegation,
                'mobilePhone' => $this->mobilePhone,
                'officePhone' => $this->officePhone,
                'extension' => $this->extension,
                'curp' => $this->curp,
            ]
        );

        // $this->emit('privilegesUser');
        // $this->reset([]);
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
