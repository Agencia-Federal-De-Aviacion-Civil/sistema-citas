<?php

namespace App\Http\Livewire\Medicine\AuthorizedThird\Appointments;

use App\Models\Catalogue\Municipal;
use App\Models\Catalogue\State;
use App\Models\UserParticipant;
use App\Models\User;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Hash;

class ScheduleAppointments extends Component
{

    public $dateNow, $states, $municipals;
    public $curp_search, $userParticipant, $status, $title, $stepsprogress,$idTypeAppointment,$user_appoimnet;
    public $user_id, $id_register, $name_search, $apParental_search, $apMaternal_search, $curp_searchs, $email_search, $name, $apParental, $apMaternal, $genre, $birth, $state_id, $municipal_id, $age, $street, $nInterior, $nExterior, $suburb, $postalCode, $federalEntity,
        $delegation, $mobilePhone, $officePhone, $extension, $curp, $email, $password = '', $passwordConfirmation = '', $edad;

    use Actions;
    public function rules()
    {
        return [
            'name' => 'required',
            'apParental' => 'required',
            'apMaternal' => 'required',
            'genre' => 'required',
            'birth' => 'required',
            'state_id' => 'required',
            'municipal_id' => 'required',
            'age' => 'required|max:2',
            'street' => 'required',
            'nInterior' => '',
            'nExterior' => '',
            'suburb' => 'required',
            'postalCode' => 'required',
            'federalEntity' => 'required',
            'delegation' => 'required',
            'mobilePhone' => 'required|max:10',
            'officePhone' => 'max:10',
            'extension' => '',
            'curp' => 'required|unique:user_participants|max:18|min:18',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|same:passwordConfirmation'
        ];
    }

    public function mount()
    {
        Date::setLocale('es');
        $this->dateNow = Date::now()->format('l j F Y');
        $this->states = State::all();
        $this->municipals = collect();
        $this->stepsprogress = 1;
        session(['idType' => 2]);
    }

    public function render()
    {
        return view('livewire.medicine.authorized-third.appointments.schedule-appointments');
    }
    public function updatedStateId($id)
    {
        $this->municipals = Municipal::with('municipalState')->where('state_id', $id)->get();
    }

    public function updatedEmail()
    {
        $this->validate(['email' => 'unique:users']);
    }

    public function updatedCurp()
    {
        $this->validate(['curp' => 'unique:user_participants']);
    }
    public function updatedbirth()
    {
        $this->edad = Carbon::parse($this->birth)->age;
        $this->age = $this->edad;
    }

    public function clean()
    {
        $this->reset([
            'user_id',
            'name',
            'apParental',
            'apMaternal',
            'genre',
            'birth',
            'state_id',
            'municipal_id',
            'age',
            'street',
            'nInterior',
            'nExterior',
            'suburb',
            'postalCode',
            'federalEntity',
            'delegation',
            'mobilePhone',
            'officePhone',
            'extension',
            'curp',
            'email',
            'password',
            'passwordConfirmation',
            'user_appoimnet'
        ]);
    }

    public function searchcurp()
    {
        $this->validate(['curp_search' => 'required|max:18|min:18']);
        $this->userParticipant = UserParticipant::with('userParticipantUser')->where('curp', $this->curp_search)->get();
        if (count($this->userParticipant) == 1) {
            $this->status = '1';
            $this->title = 'VERIFICAR DATOS';
            $this->name_search = $this->userParticipant[0]->userParticipantUser->name;
            $this->apParental_search = $this->userParticipant[0]->apParental;
            $this->apMaternal_search = $this->userParticipant[0]->apMaternal;
            $this->curp_searchs = $this->userParticipant[0]->curp;
            $this->email_search = $this->userParticipant[0]->userParticipantUser->email;
            $this->user_appoimnet=$this->userParticipant[0]->userParticipantUser->id;
        } else {
            $this->status = '2';
            $this->title = 'REGISTAR USUARIO';
            $this->curp = $this->curp_search;
            $this->notification([
                'title'       => 'NO SE ENCONTRO REGISTRO',
                'icon'        => 'info',
                'timeout' => '3100'
            ]);
        }
    }

    public function register()
    {
        $this->validate();
        try {
            $user = User::create(
                [
                    'name' => strtoupper($this->name),
                    'email' => $this->email,
                    'password' => Hash::make($this->password),
                ]
            )->assignRole('user');
            $user->userParticipant()->create([
                'user_id' => $user->id,
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
            ]);
            $this->notification([
                'title'       => 'SE REGISTRO CORRECTAMENTE',
                'icon'        => 'success',
                'timeout' => '3100'
            ]);
            $this->curp_search = $this->curp;
            $this->clean();
            
            $this->searchcurp();
        } catch (\Exception $e) {
            $this->dialog([
                'title'       => $e->getMessage(),
                'icon'        => 'error',
            ]);
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Campo obligatorio',
            'apParental.required' => 'Campo obligatorio',
            'apMaternal.required' => 'Campo obligatorio',
            'genre.required' => 'Campo obligatorio',
            'birth.required' => 'Campo obligatorio',
            'state_id.required' => 'Campo obligatorio',
            'municipal_id.required' => 'Campo obligatorio',
            'age.required' => 'Campo obligatorio',
            'street.required' => 'Campo obligatorio',
            'suburb.required' => 'Campo obligatorio',
            'postalCode.required' => 'Campo obligatorio',
            'federalEntity.required' => 'Campo obligatorio',
            'delegation.required' => 'Campo obligatorio',
            'mobilePhone.required' => 'Campo obligatorio',
            'officePhone.required' => 'Campo obligatorio',
            'extension.required' => 'Campo obligatorio',
            'curp.required' => 'Campo obligatorio',
            'curp.unique' => 'El curp ingresado ya se ha registrado',
            'curp.max' => 'Máximo 18 caracteres',
            'curp.min' => 'Mínimo 18 caracteres',
            'email.required' => 'Campo obligatorio',
            'email.email' => 'No valido',
            'email.unique' => 'El correo electrónico registrado ya existe',
            'password.required' => 'Campo obligatorio',
            'password.min' => 'Minímo 8 carácteres',
            'password.same' => 'Las contraseñas no coinciden',
        ];
    }
}
