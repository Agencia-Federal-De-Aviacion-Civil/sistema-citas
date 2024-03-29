<?php

namespace App\Http\Livewire\Register;

use App\Models\Catalogue\Municipal;
use App\Models\Catalogue\State;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use WireUi\Traits\Actions;

class Index extends Component
{
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
    public $user_id, $id_register, $name, $apParental, $apMaternal, $genre, $birth, $state_id, $municipal_id, $age, $street, $nInterior, $nExterior, $suburb, $postalCode, $federalEntity,
        $delegation, $mobilePhone, $officePhone, $extension, $curp, $email, $password = '', $passwordConfirmation = '';
    public $states, $municipals;

    public function mount()
    {
        $this->states = State::all();
        $this->municipals = collect();
    }

    public function render()
    {
        return view('livewire.register.index');
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
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function register()
    {
        $this->validate();
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
        auth()->login($user);
        return redirect()->route('afac.home');
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
