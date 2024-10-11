<?php

namespace App\Http\Livewire\Register;

use App\Models\Catalogue\Municipal;
use App\Models\Catalogue\State;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use WireUi\Traits\Actions;
use App\Models\catalogue\Sex;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Carbon\Carbon;


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
    public $birth_prfle, $rfc_prfle, $enabled, $sex_api, $formattedBirthDate, $age_prfle, $rfc_prfle_api, $curp_api, $sexes, $country_birth_prfle,$state_birth_prfle, $nationality_prfle, $countries;
    public $user_id, $id_register, $name, $apParental, $apMaternal, $genre, $birth, $state_id, $municipal_id, $age, $street, $nInterior, $nExterior, $suburb, $postalCode, $federalEntity,
        $delegation, $mobilePhone, $officePhone, $extension, $curp, $email, $password = '', $passwordConfirmation = '';
    public $states, $municipals;

    public function mount()
    {
        $this->states = State::all();
        $this->municipals = collect();
    }

    public function searchRenapo()
    {
        $this->validate([
            'curp' => 'required|unique:user_participants', // 'curp' => 'required|unique:user_profiles|max:18|min:18',
        ]);
        if (checkdnsrr('crp.sct.gob.mx', 'A')) {
            $curp = Str::upper($this->curp);
            $response = Http::connectTimeout(10)->get('https://crp.sct.gob.mx/RenapoSct/consulta/porCurp?curp=' . $curp);
            if ($response->successful() && $response->json()['resultado']['data']['statusOper'] === 'EXITOSO') {
                $response->json()['resultado'];
                $this->enabled = true;
                $this->name = $response->json()['resultado']['data']['nombres'];
                $this->apParental = $response->json()['resultado']['data']['apPaterno'];
                $this->apMaternal = $response->json()['resultado']['data']['apMaterno'];
                $this->birth_prfle = $response->json()['resultado']['data']['fechNac'];
                $this->curp_api = $response->json()['resultado']['data']['curp'];
                $this->rfc_prfle_api = Str::upper(substr($this->curp_api, 0, 10));
                $this->rfc_prfle = $this->rfc_prfle_api;
                $this->sex_api = $response->json()['resultado']['data']['sexo'];
                $this->genre = $this->sex_api == 'H' ? 1 : ($this->sex_api === 'M' ? 2 : ($this->sex_api === 'X' ? 3 : ''));

                $this->state_birth_prfle = $response->json()['resultado']['data']['cveEntidadNac'];
                $codeCountry = $response->json()['resultado']['data']['nacionalidad'];
                // foreach ($this->countries as $country) {
                //     if ($country->code_country === $codeCountry) {
                //         $this->country_birth_prfle = $country->name_country;
                //         $this->nationality_prfle = $country->nacionality_country;
                //         break;
                //     }
                // }

                $birthDate = Carbon::createFromFormat('d/m/Y', $this->birth_prfle);
                $this->formattedBirthDate = $birthDate->format('Y-m-d');
                $currentDate = Carbon::now();
                $age = $currentDate->diff($birthDate)->format('%y');
                $this->age_prfle = intval($age);

                // $this->notification()->send([
                //     'icon' => 'success',
                //     'title' => 'Búsqueda éxitosa!',
                //     'description' => 'Usuario localizado con éxito.',
                //     'timeout' => '2100'
                // ]);
            } elseif ($response->successful() && $response->json()['resultado']['data']['statusOper'] === 'NO EXITOSO') {
                $this->clean();
                // $this->notification()->send([
                //     'icon' => 'error',
                //     'title' => 'Búsqueda no éxitosa!',
                //     'description' => 'Usuario no localizado.',
                // ]);
            } else {
                // $this->dispatch('openModal', 'tools.exception-modal', (['codeError' => $response->status()]));
            }
        } else {
            // $this->notification()->send([
            //     'icon' => 'info',
            //     'title' => 'Sin conexión!',
            //     'description' => 'No hay conexión, vuelve a intentarlo.',
            // ]);
        }
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
    // public function updatedCurp()
    // {
    //     $this->validate(['curp' => 'unique:user_participants']);
    // }
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
