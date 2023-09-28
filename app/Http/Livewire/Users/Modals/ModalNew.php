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
    public $headquarters, $userPrivileges, $isVerified;
    public function rules()
    {
        $rules =  [
            'name' => 'required',
            'apParental' => 'required',
            'apMaternal' => 'required',
            'privileges' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->privilegesId)],
            'headquarter_id' => 'required_if:privileges,headquarters,sub_headquarters'
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
            $this->isVerified = $this->userPrivileges[0]->email_verified_at !== null;
            $this->id_save = $this->userPrivileges[0]->id;
            $this->id_update = isset($this->userPrivileges[0]->UserParticipant[0]->id) ? $this->userPrivileges[0]->UserParticipant[0]->id : '';
            $this->user_headquarter_id = isset($this->userPrivileges[0]->UserParticipant[0]->userParticipantUserHeadquarter[0]->id) ? $this->userPrivileges[0]->UserParticipant[0]->userParticipantUserHeadquarter[0]->id : '';
            $this->privileges = isset($this->userPrivileges[0]->roles[0]->name) ? $this->userPrivileges[0]->roles[0]->name : '';
            $this->name = $this->userPrivileges[0]->name;
            $this->apParental = isset($this->userPrivileges[0]->UserParticipant[0]->apParental) ? $this->userPrivileges[0]->UserParticipant[0]->apParental : '';
            $this->headquarter_id = isset($this->userPrivileges[0]->UserParticipant[0]->userParticipantUserHeadquarter[0]->headquarter_id) ? $this->userPrivileges[0]->UserParticipant[0]->userParticipantUserHeadquarter[0]->headquarter_id : '';
            $this->apMaternal = isset($this->userPrivileges[0]->UserParticipant[0]->apMaternal) ? $this->userPrivileges[0]->UserParticipant[0]->apMaternal : '';
            $this->email = $this->userPrivileges[0]->email;
            $this->state_id = isset($this->userPrivileges[0]->UserParticipant[0]->state_id) ? $this->userPrivileges[0]->UserParticipant[0]->state_id : '';
            $this->updatedStateId($this->state_id);
            $this->municipal_id = isset($this->userPrivileges[0]->UserParticipant[0]->municipal_id) ? $this->userPrivileges[0]->UserParticipant[0]->municipal_id : '';
            $this->genre = isset($this->userPrivileges[0]->UserParticipant[0]->genre) ? $this->userPrivileges[0]->UserParticipant[0]->genre : '';
            $this->curp = isset($this->userPrivileges[0]->UserParticipant[0]->curp) ? $this->userPrivileges[0]->UserParticipant[0]->curp : '';
            $this->birth = isset($this->userPrivileges[0]->UserParticipant[0]->birth) ? $this->userPrivileges[0]->UserParticipant[0]->birth : '';
            $this->age = isset($this->userPrivileges[0]->UserParticipant[0]->age) ? $this->userPrivileges[0]->UserParticipant[0]->age : '';
            $this->street = isset($this->userPrivileges[0]->UserParticipant[0]->street) ? $this->userPrivileges[0]->UserParticipant[0]->street : '';
            $this->nInterior = isset($this->userPrivileges[0]->UserParticipant[0]->nInterior) ? $this->userPrivileges[0]->UserParticipant[0]->nInterior : '';
            $this->nExterior = isset($this->userPrivileges[0]->UserParticipant[0]->nExterior) ? $this->userPrivileges[0]->UserParticipant[0]->nExterior : '';
            $this->suburb = isset($this->userPrivileges[0]->UserParticipant[0]->suburb) ? $this->userPrivileges[0]->UserParticipant[0]->suburb : '';
            $this->postalCode = isset($this->userPrivileges[0]->UserParticipant[0]->postalCode) ? $this->userPrivileges[0]->UserParticipant[0]->postalCode : '';
            $this->federalEntity = isset($this->userPrivileges[0]->UserParticipant[0]->federalEntity) ? $this->userPrivileges[0]->UserParticipant[0]->federalEntity : '';
            $this->delegation = isset($this->userPrivileges[0]->UserParticipant[0]->delegation) ? $this->userPrivileges[0]->UserParticipant[0]->delegation : '';
            $this->mobilePhone = isset($this->userPrivileges[0]->UserParticipant[0]->mobilePhone) ? $this->userPrivileges[0]->UserParticipant[0]->mobilePhone : '';
            $this->officePhone = isset($this->userPrivileges[0]->UserParticipant[0]->officePhone) ? $this->userPrivileges[0]->UserParticipant[0]->officePhone : '';
            $this->extension = isset($this->userPrivileges[0]->UserParticipant[0]->extension) ? $this->userPrivileges[0]->UserParticipant[0]->extension : '';
        } else {
            $this->privilegesId = null;
        }
    }
    public function verified()
    {
        $idVerify = $this->userPrivileges[0]->id;
        $user = User::find($idVerify);
        $user->email_verified_at = now();
        $user->save();
        $this->isVerified = true;
        medicine_history_movements::create([
            'user_id' => Auth::user()->id,
            'action' => "VERIFICA CORREO",
            'process' => 'USUARIO: ' . $this->name . ' ' . $this->apParental . ' ' . $this->apMaternal . ' ID:' . $idVerify
        ]);
    }
    public function render()
    {
        return view('livewire.users.modals.modal-new', ['isVerified' => $this->isVerified]);
    }
    public function updatedStateId($id)
    {
        $this->select = 0;
        $this->municipals = Municipal::with('municipalState')->where('state_id', $id)->get();
    }

    public function updatedprivileges($name)
    {
        if ($name == 'headquarters_authorized'){
            $this->headquarters = Headquarter::where('is_external', true)
            ->where('system_id', 1)->get();
        }else{
            $this->headquarters = Headquarter::where('is_external', false)
            ->where('system_id', 1)->get();
        }
    }
    public static function modalMaxWidth(): string
    {
        return '3xl';
    }
    public function clean()
    {
        $this->reset(['name', 'email', 'password', 'apParental', 'apMaternal']);
    }
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
                    'apParental' => $this->apParental ?: '',
                    'apMaternal' => $this->apMaternal ?: '',
                    'genre' => $this->genre ?: '',
                    'birth' => $this->birth ?: '',
                    'state_id' => $this->state_id ?: '7',
                    'municipal_id' => $this->municipal_id ?: '218',
                    'age' => $this->age ?: '',
                    'street' => $this->street ?: '',
                    'nInterior' => $this->nInterior ?: '',
                    'nExterior' => $this->nExterior ?: '',
                    'suburb' => $this->suburb ?: '',
                    'postalCode' => $this->postalCode ?: '',
                    'federalEntity' => $this->federalEntity ?: '',
                    'delegation' => $this->delegation ?: '',
                    'mobilePhone' => $this->mobilePhone ?: '',
                    'officePhone' => $this->officePhone ?: '',
                    'extension' => $this->extension ?: '',
                    'curp' => $this->curp,
                ]
            );
            if ($this->privileges === 'headquarters' || $this->privileges === 'sub_headquarters'|| $this->privileges === 'headquarters_authorized') {
                UserHeadquarter::updateOrCreate(
                    ['id' => $this->user_headquarter_id],
                    [
                        'headquarter_id' => $this->headquarter_id,
                        'user_participant_id' => $user_participants->id
                    ]
                );
            }
            $this->notification([
                'title'       => 'USUARIO AGREGADO CON EXITO',
                'icon'        => 'success',
                'timeout' => '3100'
            ]);
            $this->emit('privilegesUser');
        } catch (\Exception $e) {
            $this->dialog([
                'title'       => $e->getMessage(),
                'icon'        => 'error',
            ]);
        }
        $this->closeModal();
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
