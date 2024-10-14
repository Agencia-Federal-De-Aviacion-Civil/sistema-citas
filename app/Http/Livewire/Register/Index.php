<?php

namespace App\Http\Livewire\Register;

use App\Models\Catalogue\Country;
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
use Illuminate\Support\Facades\Cache;

use function Deployer\Support\array_all;

class Index extends Component
{
    use Actions;
    public $rfc_participant, $enabled, $sex_api, $formattedBirthDate, $age_participant, $rfc_participant_api, $curp_api, $sexes, $country_birth, $state_birth_participant, $nationality_participant, $countries;
    public $user_id, $id_register, $name, $apParental, $apMaternal, $genre, $birth, $state_id, $municipal_id, $age, $street, $nInterior, $nExterior, $suburb, $postalCode, $federalEntity,
        $delegation, $mobilePhone, $officePhone, $extension, $curp, $email, $password = '', $passwordConfirmation = '';
    public $states, $municipals, $country_birth_participant, $rfc_company_participant, $apiStates = [], $country_id, $apiMunicipals = [];

    public function rules()
    {
        return [
            // datos pesonales
            'curp' => 'required|unique:user_participants|max:18|min:18',
            'name' => 'required',
            'apParental' => 'required',
            'apMaternal' => 'required',
            'genre' => 'required',
            'country_birth_participant' => 'required',
            'nationality_participant' => 'required',
            'state_birth_participant' => 'required',
            'birth' => 'required',
            'age' => 'required|max:2',
            'rfc_participant' => 'required|unique:user_participants|min:10',
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

        ];
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
        // collect();

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
                $this->birth = $response->json()['resultado']['data']['fechNac'];

                // dump($this->birth);

                $this->curp_api = $response->json()['resultado']['data']['curp'];
                $this->rfc_participant_api = Str::upper(substr($this->curp_api, 0, 10));
                $this->rfc_participant = $this->rfc_participant_api;
                $this->sex_api = $response->json()['resultado']['data']['sexo'];
                $this->genre = $this->sex_api == 'H' ? 'Masculino' : ($this->sex_api === 'M' ? 'Femenino' : ($this->sex_api === 'X' ? 3 : ''));

                // dump($this->genre);

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


                // $this->notification([
                //     'title'       => 'PAGO VERIFICADO',
                //     'description' => 'EL PAGO SE HA VERIFICADO CORRECTAMENTE',
                //     'icon'        => 'success',
                //     'timeout' => '2500'
                // ]);

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

    public function updatedCountryId($country_id)
    {
        // dump($country_id);
        // $statesQuery = $this->states->where('country_id', $country_id);
        // $this->states_query = $statesQuery->map(function ($statesArray) {
        //     return [
        //         'id' => $statesArray->id,
        //         'name_state' => $statesArray->name_state
        //     ];
        // })->values()->toArray();
        // $this->dispatch(
        //     'updated-state',
        //     $this->states_query
        // );
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

            // dump($this->apiStates['id']);

            // dump($this->);
            // foreach($this->apiStates as $apiState){

            //     dump($apiState['id']);
            // }

            // dump($this->apiStates);
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

        // $state_participant_separated = explode(',', $state_prfile);
        // $state_participant_id = reset($state_participant_separated);
        // $municipalityQuery = $this->municipalities->where('state_id', $state_participant_id);
        // $this->municipalities_query = $municipalityQuery->map(function ($municipalitiesArray) {
        //     return [
        //         'id' => $municipalitiesArray->id,
        //         'municipality_name' => $municipalitiesArray->municipality_name
        //     ];
        // })->values()->toArray();
        // $this->dispatch(
        //     'updated-municipal',
        //     $this->municipalities_query
        // );

        // $state_prfile_separated = explode(',', $state_id);
        // $state_prfile_id = reset($state_id);
        if (is_numeric($state_id)) {
            $response = Http::withHeaders([
                'api-key' => '0kKvNnbwrzoNoXnHl2dgIt1rm',
                // env('API_KEY'),
                'Accept' => 'application/json'
            ])->connectTimeout(30)->get('https://cit.sct.gob.mx/sict/catalogs/getMunicipios/' . $state_id);
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
            'country_birth_participant' => $this->country_birth_participant,
            'nationality_participant' => $this->nationality_participant,
            'state_birth_participant' => $this->state_birth_participant,
            'birth' => $this->formattedBirthDate,
            'state_id' => 1,
            // $this->state_id,
            'municipal_id' => 1,
            // $this->municipal_id,
            'age' => $this->age,
            'rfc_participant' => $this->rfc_participant,
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
        return redirect()->route('afac.home');
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
        ];
    }
}
