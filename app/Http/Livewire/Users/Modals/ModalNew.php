<?php

namespace App\Http\Livewire\Users\Modals;

use App\Models\Catalogue\Headquarter;
use App\Models\Catalogue\Municipal;
use App\Models\Catalogue\State;
use App\Models\User;
use App\Models\UserParticipant;
use App\Models\Medicine\medicine_history_movements;
use App\Models\UserHeadquarter;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Auth;

class ModalNew extends ModalComponent
{
    use Actions;
    use WithFileUploads;
    public $roles, $modal, $id_save, $id_update, $name, $email, $apParental, $apMaternal, $state_id, $municipal_id, $password, $passwordConfirmation, $privileges, $privilegesId, $title, $email_verified, $dateNow,
        $genre, $birth, $age, $street, $nInterior, $nExterior, $suburb, $postalCode, $federalEntity, $delegation, $mobilePhone, $officePhone, $extension, $curp, $states, $municipals, $municipio, $select, $user_headquarter_id,
        $headquarter_id;
    public $headquarters, $userPrivileges;
    public function rules()
    {
        $rules =  [
            'name' => 'required',
            'apParental' => 'required',
            'apMaternal' => 'required',
            'privileges' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->privilegesId)],
            'headquarter_id' => 'required_if:privileges,headquarters'
        ];
        $rules['password'] = $this->privilegesId ? 'same:passwordConfirmation' : 'required|min:6|same:passwordConfirmation';
        return $rules;
    }
    public function mount($privilegesId = null)
    {
        $this->headquarters = Headquarter::all();
        $this->roles = Role::all();
        $this->states = State::all();
        $this->municipals = collect();
        if (isset($privilegesId)) {
            $this->privilegesId = $privilegesId;
            $this->userPrivileges = User::with('roles', 'UserParticipant.userParticipantUserHeadquarter')->where('id', $this->privilegesId)->get();
            $this->id_save = $this->userPrivileges[0]->id;
            $this->id_update = $this->userPrivileges[0]->UserParticipant[0]->id;
            $this->user_headquarter_id = $this->userPrivileges[0]->UserParticipant[0]->userParticipantUserHeadquarter[0]->id;
            $this->privileges = $this->userPrivileges[0]->roles[0]->name;
            $this->name = $this->userPrivileges[0]->name;
            $this->apParental = $this->userPrivileges[0]->UserParticipant[0]->apParental;
            $this->headquarter_id = isset($this->userPrivileges[0]->UserParticipant[0]->userParticipantUserHeadquarter[0]->headquarter_id) ? $this->userPrivileges[0]->UserParticipant[0]->userParticipantUserHeadquarter[0]->headquarter_id : '';
            $this->apMaternal = $this->userPrivileges[0]->UserParticipant[0]->apMaternal;
            $this->email = $this->userPrivileges[0]->email;
            $this->state_id = $this->userPrivileges[0]->UserParticipant[0]->state_id;
            $this->updatedStateId($this->state_id);
            $this->municipal_id = $this->userPrivileges[0]->UserParticipant[0]->municipal_id;
            $this->genre = $this->userPrivileges[0]->UserParticipant[0]->genre;
            $this->curp = $this->userPrivileges[0]->UserParticipant[0]->curp;
            $this->birth = $this->userPrivileges[0]->UserParticipant[0]->birth;
            $this->age = $this->userPrivileges[0]->UserParticipant[0]->age;
            $this->street = $this->userPrivileges[0]->UserParticipant[0]->street;
            $this->nInterior = $this->userPrivileges[0]->UserParticipant[0]->nInterior;
            $this->nExterior = $this->userPrivileges[0]->UserParticipant[0]->nExterior;
            $this->suburb = $this->userPrivileges[0]->UserParticipant[0]->suburb;
            $this->postalCode = $this->userPrivileges[0]->UserParticipant[0]->postalCode;
            $this->federalEntity = $this->userPrivileges[0]->UserParticipant[0]->federalEntity;
            $this->delegation = $this->userPrivileges[0]->UserParticipant[0]->delegation;
            $this->mobilePhone = $this->userPrivileges[0]->UserParticipant[0]->mobilePhone;
            $this->officePhone = $this->userPrivileges[0]->UserParticipant[0]->officePhone;
            $this->extension = $this->userPrivileges[0]->UserParticipant[0]->extension;
        } else {
            $this->privilegesId = null;
        }
    }
    public function render()
    {
        return view('livewire.users.modals.modal-new');
    }
    public function updatedStateId($id)
    {
        $this->select = 0;
        $this->municipals = Municipal::with('municipalState')->where('state_id', $id)->get();
    }
    public static function modalMaxWidth(): string
    {
        return '3xl';
    }
    public function clean()
    {
        $this->reset(['name', 'email', 'password', 'apParental', 'apMaternal']);
    }
    // public function valores($privilegesId)
    // {
    //     $this->privilegesId = $privilegesId;
    //     if ($this->privilegesId != 0) {
    //         $userPrivileges = User::with('roles', 'UserParticipant')->where('id', $this->privilegesId)->get();
    //         $this->id_save = $userPrivileges[0]->id;
    //         $this->name = $userPrivileges[0]->name;
    //         $this->apParental = $userPrivileges[0]->UserParticipant[0]->apParental;
    //         $this->apMaternal = $userPrivileges[0]->UserParticipant[0]->apMaternal;
    //         $this->state_id = $userPrivileges[0]->UserParticipant[0]->state_id;
    //         $this->municipal_id = $userPrivileges[0]->UserParticipant[0]->municipal_id;
    //         $this->municipio = $userPrivileges[0]->UserParticipant[0]->participantMunicipal->name;
    //         $this->email = $userPrivileges[0]->email;
    //         $this->privileges = $userPrivileges[0]->roles[0]->name;
    //         $this->title = 'EDITAR USUARIO';
    //         $this->id_update = $userPrivileges[0]->UserParticipant[0]->id;
    //         $this->genre = $userPrivileges[0]->UserParticipant[0]->genre;
    //         $this->birth = $userPrivileges[0]->UserParticipant[0]->birth;
    //         $this->age = $userPrivileges[0]->UserParticipant[0]->age;
    //         $this->street = $userPrivileges[0]->UserParticipant[0]->street;
    //         $this->nInterior = $userPrivileges[0]->UserParticipant[0]->nInterior;
    //         $this->nExterior = $userPrivileges[0]->UserParticipant[0]->nExterior;
    //         $this->suburb = $userPrivileges[0]->UserParticipant[0]->suburb;
    //         $this->postalCode = $userPrivileges[0]->UserParticipant[0]->postalCode;
    //         $this->federalEntity = $userPrivileges[0]->UserParticipant[0]->federalEntity;
    //         $this->delegation = $userPrivileges[0]->UserParticipant[0]->delegation;
    //         $this->mobilePhone = $userPrivileges[0]->UserParticipant[0]->mobilePhone;
    //         $this->officePhone = $userPrivileges[0]->UserParticipant[0]->officePhone;
    //         $this->extension = $userPrivileges[0]->UserParticipant[0]->extension;
    //         $this->curp = $userPrivileges[0]->UserParticipant[0]->curp;

    //         $this->email_verified = $userPrivileges[0]->email_verified_at;
    //     } else {
    //         $this->title = 'AGREGAR USUARIO';
    //         $this->state_id = 1;
    //         $this->municipal_id = 1;
    //         $this->genre = 0;
    //         $this->birth = 0;
    //         $this->age = 0;
    //         $this->street = 0;
    //         $this->nInterior = 0;
    //         $this->nExterior = 0;
    //         $this->suburb = 0;
    //         $this->postalCode = 0;
    //         $this->federalEntity = 0;
    //         $this->delegation = 0;
    //         $this->mobilePhone = 0;
    //         $this->officePhone = 0;
    //         $this->extension = 0;
    //         $this->curp = 0;
    //     }
    // }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function save()
    {
        $this->validate();
        try {
            $userData = [
                'name' => $this->name,
                'email' => $this->email,
            ];
            if (!$this->privilegesId || $this->password != '') {
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
            $userHeadquarters = UserHeadquarter::updateOrCreate(
                ['id' => $this->user_headquarter_id],
                [
                    'headquarter_id' => $this->headquarter_id,
                    'user_participant_id' => $user_participants->id
                ]
            );
            $this->notification([
                'title'       => 'USUARIO AGREGADO CON EXITO',
                'icon'        => 'success',
                'timeout' => '3100'
            ]);
            $this->emit('privilegesUser');
        } catch (\Exception $e) {
            $this->notification([
                'title'       => $e->getMessage(),
                'icon'        => 'error',
                'timeout' => '3100'
            ]);
        }
        $this->closeModal();
    }
    public function verified($id_save)
    {
        Date::setLocale('es');
        $this->dateNow = Date::now()->format('Y-m-d h:i:s');
        $verifiedUser = User::where('id', $id_save);
        $verifiedUser->update([
            'email_verified_at' => $this->dateNow,
        ]);
        //save history veryficate e-mail
        medicine_history_movements::create([
            'user_id' => Auth::user()->id,
            'action' => "VERIFICA CORREO",
            'process' => 'USUARIO: ' . $this->name . ' ' . $this->apParental . ' ' . $this->apMaternal . ' ID:' . $id_save
        ]);

        $this->valores($id_save);
    }

    public function messages()
    {
        return [
            'name.required' => 'Campo obligatorio',
            'email.required' => 'Campo obligatorio',
            'email.email' => 'No valido',
            'email.unique' => 'El correo electrónico registrado ya existe',
            'headquarter_id.required_if' => 'Campo obligatorio',
            'apParental.required' => 'Campo obligatorio',
            'apMaternal.required' => 'Campo obligatorio',
            'privileges.required' => 'Seleccione rol',
            'password.required' => 'Campo obligatorio',
            'password.min' => 'Minímo 8 carácteres',
            'password.same' => 'Las contraseñas no coinciden',
        ];
    }
}
