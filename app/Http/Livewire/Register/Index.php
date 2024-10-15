<?php

namespace App\Http\Livewire\Register;

use App\Models\Catalogue\Country;
use App\Models\Catalogue\Municipal;
use App\Models\Catalogue\State;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use WireUi\Traits\Actions;
use App\Models\catalogue\Sex;
use App\Models\Tenant\DataBaseTenant;
use App\Models\Tenant\DataRoles;
use App\Models\Tenant\DataUserProfiles;
use App\Models\Tenant\DataUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use function Deployer\Support\array_all;

class Index extends Component
{
    use Actions;



    public $rfc_participant, $enabled, $sex_api, $formattedBirthDate, $age_participant, $rfc_participant_api, $curp_api, $sexes, $country_birth, $state_birth_participant, $nationality_participant, $countries;
    public $user_id, $id_register, $name, $apParental, $apMaternal, $genre, $birth, $state_id, $municipal_id, $age, $street, $nInterior, $nExterior, $suburb, $postalCode, $federalEntity,
        $delegation, $mobilePhone, $officePhone, $extension, $curp, $email, $password = '', $passwordConfirmation = '';
    public $states, $municipals, $country_birth_participant, $rfc_company_participant, $name_company_participant, $apiStates = [], $country_id, $apiMunicipals = [], $confirm_privacity;
    public $user, $sex_id, $state_name_separated, $municipal_name_separated;
    public function rules()
    {
        return [
            // datos pesonales
            // 'curp' => 'required|unique:user_participants|max:18|min:18',
            'name' => 'required',
            'apParental' => 'required',
            'apMaternal' => 'required',
            'genre' => 'required',
            'country_birth_participant' => 'required',
            'nationality_participant' => 'required',
            'state_birth_participant' => 'required',
            'birth' => 'required',
            'age' => 'required|max:2',
            //domicilio
            'country_id' => 'required',
            'state_id' => 'required',
            'municipal_id' => 'required',
            'street' => 'required',
            'nInterior' => '',
            'nExterior' => '',
            'postalCode' => 'required',
            'suburb' => 'required',
            'delegation' => 'required', // LOCALIAD
            // 'federalEntity' => 'required', // NO APLICA
            //datos de contacto
            'mobilePhone' => 'required|max:10',
            'officePhone' => 'max:10',
            'extension' => '',
            'email' => 'required|email|unique:users',
            //datos de empresa
            // 'rfc_company_participant'
            // name_company_participant
            //datos de acceso
            'password' => 'required|min:6|same:passwordConfirmation',
            'confirm_privacity' => 'required',
        ];
    }


    public function clean()
    {
        $this->reset([
            'name',
            'email',
            'password',
            'sex_id',
            'genre',
            'country_id',
            'apParental',
            'apMaternal',
            'rfc_participant',
            'birth',
            'age',
            'street',
            'state_birth_participant',
            'nationality_participant',
            'country_birth_participant',
            'state_id',
            'municipal_id',
            'nInterior',
            'nExterior',
            'postalCode',
            'suburb',
            'mobilePhone',
            'officePhone',
            'extension',
            'delegation', // LOCALIAD
            'rfc_company_participant',
            'name_company_participant',
        ]);
    }

    public function mount()
    {
        $this->states = State::all();
        $this->municipals = collect();
        $response = Http::withHeaders([
            'api-key' => '0kKvNnbwrzoNoXnHl2dgIt1rm',
            // env('API_KEY'),
            'Accept' => 'application/json'
        ])->connectTimeout(30)->get('https://cit.sct.gob.mx/sict/catalogs/getEstados/' . 1);
        if ($response->successful()) {
            $statesSuccess = $response->json()['data'];
            $this->apiStates = collect($statesSuccess)->map(function ($apiStateSuccess) {
                return [
                    'id' => $apiStateSuccess['estadoIdDTO'],
                    'name_state' => $apiStateSuccess['nombreEstadoDTO']
                ];
            });
        }

        $response = Http::withHeaders([
            'api-key' => '0kKvNnbwrzoNoXnHl2dgIt1rm',
            // env('API_KEY'),
            'Accept' => 'application/json'
        ])->connectTimeout(30)->get('https://cit.sct.gob.mx/sict/catalogs/getMunicipios/' . 1);
        if ($response->successful()) {
            $municipalSuccess = $response->json()['data'];
            $this->apiMunicipals = collect($municipalSuccess)->map(function ($apiStateSuccess) {
                return [
                    'id' => $apiStateSuccess['municipioIdDTO'],
                    'name_municipal' => $apiStateSuccess['nombreMunicipioDTO']
                ];
            });
        }

        if (Cache::has('country_query')) {
            $this->countries = Cache::get('country_query');
        } else {
            $this->countries = Cache::remember('country_query', now()->addMonths(1), function () {
                return Country::orderByRaw("CASE WHEN id = 165 THEN 0 ELSE 1 END")
                    ->orderBy('id')
                    ->get();
            });
        }
    }

    public function searchRenapo()
    {
        $this->validate([
            'curp' => 'required|unique:user_participants|max:18|min:18', // 'curp' => 'required|unique:user_profiles|max:18|min:18',
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
                $this->birth = $response->json()['resultado']['data']['fechNac'];
                $this->curp_api = $response->json()['resultado']['data']['curp'];
                $this->rfc_participant_api = Str::upper(substr($this->curp_api, 0, 10));
                $this->rfc_participant = $this->rfc_participant_api;
                $this->sex_api = $response->json()['resultado']['data']['sexo'];
                $this->genre = $this->sex_api == 'H' ? 'Masculino' : ($this->sex_api === 'M' ? 'Femenino' : ($this->sex_api === 'X' ? 3 : ''));
                $this->sex_id = $this->sex_api == 'H' ? 1 : ($this->sex_api === 'M' ? 2 : ($this->sex_api === 'X' ? 3 : ''));
                $this->state_birth_participant = $response->json()['resultado']['data']['cveEntidadNac'];
                $codeCountry = $response->json()['resultado']['data']['nacionalidad'];
                foreach ($this->countries as $country) {
                    if ($country->code_country === $codeCountry) {
                        $this->country_birth_participant = $country->name_country;
                        $this->nationality_participant = $country->nacionality_country;
                        break;
                    }
                }

                $birthDate = Carbon::createFromFormat('d/m/Y', $this->birth);
                $this->formattedBirthDate = $birthDate->format('Y-m-d');
                $currentDate = Carbon::now();
                $age = $currentDate->diff($birthDate)->format('%y');
                $this->age = intval($age);
                $this->notification([
                    'title'       => 'Búsqueda éxitosa!',
                    'description' => 'Usuario localizado con éxito.',
                    'icon'        => 'success',
                    'timeout' => '2500'
                ]);
            } elseif ($response->successful() && $response->json()['resultado']['data']['statusOper'] === 'NO EXITOSO') {
                $this->clean();
                $this->notification()->send([
                    'icon' => 'error',
                    'title' => 'Búsqueda no éxitosa!',
                    'description' => 'Usuario no localizado.',
                ]);
            } else {
                // $this->dispatch('openModal', 'tools.exception-modal', (['codeError' => $response->status()]));
            }
        } else {
            $this->notification()->send([
                'icon' => 'info',
                'title' => 'Sin conexión!',
                'description' => 'No hay conexión, vuelve a intentarlo.',
            ]);
        }
    }

    public function cleanSearch()
    {
        $this->enabled = false;
        $this->reset('curp');
        $this->clean();
    }

    public function updatedCountryId($country_id)
    {
        $response = Http::withHeaders([
            'api-key' => '0kKvNnbwrzoNoXnHl2dgIt1rm',
            // env('API_KEY'),
            'Accept' => 'application/json'
        ])->connectTimeout(30)->get('https://cit.sct.gob.mx/sict/catalogs/getEstados/' . $country_id);
        if ($response->successful()) {
            $statesSuccess = $response->json()['data'];

            $this->apiStates = collect($statesSuccess)->map(function ($apiStateSuccess) {
                return [
                    'id' => $apiStateSuccess['estadoIdDTO'],
                    'name_state' => $apiStateSuccess['nombreEstadoDTO']
                ];
            });
            // $this->dispatch(
            //     'updated-state',
            // $this->apiStates;
            // );
        } elseif ($response->failed()) {
            $this->dispatch('openModal', 'tools.exception-modal', (['codeError' => 'OCURRIO UN ERROR AL CONSULTAR LOS ESTADOS, VUELVE A INTENTARLO. ERROR ' . $response->status()]));
        }
    }

    public function updatedStateId($state_id)
    {
        $state_participants_separated = explode(',', $state_id);
        $state_participants_id = reset($state_participants_separated);
        $this->state_name_separated = end($state_participants_separated);

        if (is_numeric($state_participants_id)) {
            $response = Http::withHeaders([
                'api-key' => '0kKvNnbwrzoNoXnHl2dgIt1rm',
                // env('API_KEY'),
                'Accept' => 'application/json'
            ])->connectTimeout(30)->get('https://cit.sct.gob.mx/sict/catalogs/getMunicipios/' . $state_participants_id);
            if ($response->successful()) {
                $municipalSuccess = $response->json()['data'];
                $this->apiMunicipals = collect($municipalSuccess)->map(function ($apiStateSuccess) {
                    return [
                        'id' => $apiStateSuccess['municipioIdDTO'],
                        'name_municipal' => $apiStateSuccess['nombreMunicipioDTO']
                    ];
                });
                // $this->dispatch(
                //     'updated-municipal',
                //     $this->apiMunicipals
                // );
            } elseif ($response->failed()) {
                $this->dispatch('openModal', 'tools.exception-modal', (['codeError' => 'OCURRIO UN ERROR AL CONSULTAR LOS MUNICIPIOS, VUELVE A INTENTARLO. ERROR ' . $response->status()]));
            }
        }
    }
    public function updatedMunicipalId($municipal_id){
        $municipal_participants_separated = explode(',', $municipal_id);
        $this->municipal_name_separated = end($municipal_participants_separated);
    }

    public function render()
    {
        return view('livewire.register.index');
    }

    // public function updatedStateId($id)
    // {
    //     $this->municipals = Municipal::with('municipalState')->where('state_id', $id)->get();
    // }
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
        $state_id = State::where('name', Str::upper($this->state_name_separated))->pluck('id')->first();
        $municipal_id = Municipal::where('name', Str::upper($this->municipal_name_separated))->pluck('id')->first();

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
            'birth' => $this->formattedBirthDate,
            'state_id' => $state_id,
            'municipal_id' => $municipal_id,
            'age' => $this->age,
            'street' => $this->street,
            'nInterior' => $this->nInterior,
            'nExterior' => $this->nExterior,
            'suburb' => $this->suburb,
            'postalCode' => $this->postalCode,
            'federalEntity' => 'NO APLICA',
            'delegation' => $this->delegation,
            'mobilePhone' => $this->mobilePhone,
            'officePhone' => $this->officePhone,
            'extension' => $this->extension,
            'curp' => $this->curp,
        ]);
        auth()->login($user);

        $this->registerTenantUser($user);

        return redirect()->route('afac.home');
    }

    public function registerTenantUser($user)
    {
        $dataUser = DataUsers::create(
            [
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
            ]
        );
        DataRoles::insert([
            'role_id' => 1,
            'model_type' => 'App\Models\User',
            'model_id' => $dataUser->id
        ]);
        DataUserProfiles::create([
            'user_id' => $dataUser->id,
            'sex_id' => $this->sex_id,
            'country_id' => $this->country_id,
            'lst_pat_prfle' => $this->apParental,
            'lst_mat_prfle' => $this->apMaternal,
            'curp_prfle' => $this->curp,
            'rfc_prfle' => $this->rfc_participant,
            'birth_prfle' =>  $this->formattedBirthDate,
            'state_birth_prfle' => $this->state_birth_participant,
            'nationality_prfle' => $this->nationality_participant,
            'country_birth_prfle' => $this->country_birth_participant,
            'state_prfle' => Str::upper($this->state_name_separated),
            'municipality_prfle' => Str::upper($this->municipal_name_separated),
            'location_prfle' => $this->delegation,
            'street_prfle' => $this->street,
            'n_int_prfle' => $this->nInterior,
            'n_ext_prfle' => $this->nExterior,
            'suburb_prfle' => $this->suburb,
            'postal_cod_prfle' => $this->postalCode,
            'mob_phone_prfle' => $this->mobilePhone,
            'office_phone_prfle' => $this->officePhone,
            'ext_prfle' => $this->extension,
            'rfc_company_prfle' => $this->rfc_company_participant,
            'name_company_prfle' => $this->name_company_participant,
            'confirm_privacity' => $this->confirm_privacity,
        ]);
    }

    public function messages()
    {
        return [

            'country_birth_participant.required' => 'Campo obligatorio',
            'nationality_participant.required' => 'Campo obligatorio',
            'state_birth_participant.required' => 'Campo obligatorio',
            'rfc_participant.required' => 'Homoclave de RFC campo obligatorio',
            'rfc_participant.unique' => 'El RFC ya se encuentra registrado',
            'rfc_participant.min' => 'Mínimo 10 caracteres en el RFC',
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
            'confirm_privacity.required' => 'Debes confirmar que has leído el aviso de privacidad.'
        ];
    }
}
