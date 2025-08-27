<?php

namespace App\Http\Livewire\Medicine\AuthorizedThird\Appointments;

use App\Models\Catalogue\LogsApi;
use App\Models\Catalogue\Municipal;
use App\Models\Catalogue\State;
use App\Models\UserParticipant;
use App\Models\User;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ScheduleAppointments extends Component
{

    public $dateNow, $states, $municipals;
    public $curp_search, $userParticipant, $status, $title, $stepsprogress, $idTypeAppointment, $registeredUserId;
    public $user_id, $id_register, $name_search, $apParental_search, $apMaternal_search, $curp_searchs, $email_search, $name, $apParental, $apMaternal, $genre, $birth, $state_id, $municipal_id, $age, $street, $nInterior, $nExterior, $suburb, $postalCode, $federalEntity,
        $delegation, $mobilePhone, $officePhone, $extension, $curp, $email, $password = '', $passwordConfirmation = '', $edad;
    public $rfc_participant, $enabled, $sex_api, $formattedBirthDate, $age_participant, $rfc_participant_api, $curp_api, $sexes, $country_birth, $state_birth_participant, $nationality_participant, $countries;
    public $country_birth_participant, $rfc_company_participant, $name_company_participant, $apiStates = [], $country_id, $apiMunicipals = [], $confirm_privacity;
    public $user, $sex_id, $state_name_separated, $municipal_name_separated, $birth_years, $userParticipantid;
    use Actions;
    public function rules()
    {
        return [
            'name' => 'required',
            'apParental' => 'required',
            // 'apMaternal' => 'required',
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
            // 'federalEntity' => 'required',
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
        ]);
    }

    public function searchcurp()
    {
        $this->validate(['curp_search' => 'required|max:18|min:18']);
        // $this->validate([
        //     'curp' => 'required|unique:user_participants|max:18|min:18', // 'curp' => 'required|unique:user_profiles|max:18|min:18',
        // ]);

        // dump($this->curp);

        $this->userParticipant = UserParticipant::with('userParticipantUser')->where('curp', $this->curp_search)->get();

        if (count($this->userParticipant) == 1) {
            $this->status = '1';
            $this->title = 'VERIFICAR DATOS';
            $this->name_search = $this->userParticipant[0]->userParticipantUser->name;
            $this->apParental_search = $this->userParticipant[0]->apParental;
            $this->apMaternal_search = $this->userParticipant[0]->apMaternal;
            $this->curp_searchs = $this->userParticipant[0]->curp;
            $this->email_search = $this->userParticipant[0]->userParticipantUser->email;
            $this->registeredUserId = $this->userParticipant[0]->userParticipantUser->id;
            $this->emit('registeredEmit', $this->registeredUserId);
            $showBanner = true;
            $this->emit('showBanner', $showBanner);
        } else {

            $this->status = '2';
            $this->title = 'REGISTAR USUARIO';

            $this->curp = $this->curp_search;
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
                    // foreach ($this->countries as $country) {
                    // if ($country->code_country === $codeCountry) {
                    // $this->country_birth_participant = $country->name_country;
                    // $this->nationality_participant = $country->nacionality_country;
                    $this->country_birth_participant = 'MEX';
                    $this->nationality_participant = 'MEXICANA';
                    //     break;
                    // }
                    // }
                    $birthDate = Carbon::createFromFormat('d/m/Y', $this->birth);
                    $this->formattedBirthDate = $birthDate->format('Y-m-d');
                    $currentDate = Carbon::now();
                    $age = $currentDate->diff($birthDate)->format('%y');
                    $this->age = intval($age);
                    $this->notification([
                        'title'       => 'Búsqueda éxitosa!',
                        'description' => 'Usuario localizado con éxito.',
                        'icon'        => 'success',
                        'timeout' => '3100'
                    ]);
                    // $this->emit('BatchDispatch', [$this->batchId, $this->exporting, $this->exportFinished]);
                } elseif ($response->successful() && $response->json()['resultado']['data']['statusOper'] === 'NO EXITOSO') {
                    $this->clean();
                    $this->notification()->send([
                        'title'       => 'Búsqueda no éxitosa!',
                        'description' => 'Usuario no localizado.',
                        'icon'        => 'error',
                        'timeout' => '3100'
                    ]);
                } else {
                    // $this->dispatch('openModal', 'tools.exception-modal', (['codeError' => $response->status()]));
                }
            } else {
                $this->notification()->send([
                    'icon' => 'info',
                    'title' => 'Sin conexión!',
                    'description' => 'No hay conexión, vuelve a intentarlo.',
                    'timeout' => '3100'
                ]);
            }
            // $this->curp = $this->curp_search;
            // $this->notification([
            //     'title'       => 'NO SE ENCONTRO REGISTRO',
            //     'icon'        => 'info',
            //     'timeout' => '3100'
            // ]);
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
            $userParticipantid = $user->userParticipant()->create([
                'user_id' => $user->id,
                'apParental' => $this->apParental,
                'apMaternal' => $this->apMaternal ?? null,
                'genre' => $this->genre,
                'birth' => $this->formattedBirthDate,
                'state_id' => $this->state_id,
                'municipal_id' => $this->municipal_id,
                // 'state_id' => $state_id,
                // 'municipal_id' => $municipal_id,
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
            $this->emit('registeredEmit', $this->registeredUserId);
            $this->notification([
                'title'       => 'SE REGISTRO CORRECTAMENTE',
                'icon'        => 'success',
                'timeout' => '3100'
            ]);
            $this->curp_searchs = $this->curp;
            $this->userParticipantid = $userParticipantid->id;
            $this->registerTenantUser($user);
            $this->clean();
            $this->searchcurp();
        } catch (\Exception $e) {
            $this->dialog([
                'title'       => $e->getMessage(),
                'icon'        => 'error',
            ]);
        }
    }

    public function registerTenantUser($user)
    {
        $state_id = State::where('id', $this->state_id)->pluck('name')->first();
        $municipal_id = Municipal::where('id', $this->municipal_id)->pluck('name')->first();

        // dump($user->id.'---'.$this->userParticipantid);
        if (checkdnsrr('crp.sct.gob.mx', 'A')) {
             $password = Hash::make($user->password);
            $endpoint = env('SIMA_API_REGISTER', null);
            $response = Http::withHeaders([
                'AuthorizationSima' => '8X4Oeq4g3puzL77UVVu1ZfNoSGZ2R5tgdZgcuLMfpRDuHMQuvyemKgftajZjGkQX',
                'Accept' => 'application/json'
            ])->connectTimeout(30)->post(
                'https://siafac.afac.gob.mx/listStore?',
                [
                        'id' => $user->id,
                        'name' =>  $user->name,
                        'email' =>  $user->email,
                        'password' =>  $password,
                        'userParticipantid' => $this->userParticipantid,
                        'sex_id' =>  $this->sex_id,
                        'country_id' => 165,
                        'lst_pat_prfle' =>  $this->apParental,
                        'lst_mat_prfle' =>  $this->apMaternal ?? null,
                        'curp_prfle' =>  $this->curp,
                        'rfc_prfle' =>  $this->rfc_participant,
                        'birth_prfle' =>  $this->formattedBirthDate,
                        'state_birth_prfle' =>  $this->state_birth_participant,
                        'nationality_prfle' =>  $this->nationality_participant,
                        'country_birth_prfle' =>  $this->country_birth_participant,
                        'state_prfle' =>  $state_id,
                        'municipality_prfle' =>  $municipal_id,
                        'location_prfle' =>  $this->delegation,
                        'street_prfle' =>  $this->street,
                        'n_int_prfle' =>  $this->nInterior,
                        'n_ext_prfle' =>  $this->nExterior,
                        'suburb_prfle' =>  $this->suburb,
                        'postal_cod_prfle' =>  $this->postalCode,
                        'mob_phone_prfle' =>  $this->mobilePhone,
                        'office_phone_prfle' =>  $this->officePhone,
                        'ext_prfle' =>  $this->extension,
                        'rfc_company_prfle' =>  $this->rfc_company_participant,
                        'name_company_prfle' =>  $this->name_company_participant,
                        'confirm_privacity'=> 1,
                        'privileges' => 'medical_user'
                ]
            );
            // https://siafac.afac.gob.mx/listStore?
            if ($response->successful()) {
                // $statesSuccess = $response->json()['data'];
            } elseif ($response->successful() && $response->json()['data'] === 'NO EXITOSO') {
                $this->clean();
                $this->notification()->send([
                    'title'       => 'No se realizo registro!',
                    'description' => 'Usuario no registrado.',
                    'icon'        => 'error',
                    'timeout' => '3100'
                ]);
            } else {
                $error = $response->json()['message'];
                $this->LogsApi($curp_logs = $this->curp, $type = 'REGISTRO', $register = $error, $description = 'ERROR AL REALIZAR REGISTRO DE USURIO');
                $this->notification()->send([
                    'icon' => 'info',
                    'title' => 'AVISO!',
                    'description' => 'ERROR',
                    'timeout' => '3100'
                ]);
            }
        } else {
            $this->notification()->send([
                'icon' => 'info',
                'title' => 'Sin conexión!',
                'description' => 'No hay conexión, vuelve a intentarlo.',
                'timeout' => '3100'
            ]);
            $this->LogsApi($curp_logs = $this->curp, $type = 'REGISTRO', $register = 'SIN CONEXION', $description = 'No hay conexión, vuelve a intentarlo');
        }
    }

    public function LogsApi($curp_logs, $type, $register, $description)
    {
        $url = url()->previous();
        $logs =  LogsApi::create([
            'curp_logs' => $curp_logs,
            'url' => $url,
            'type' => $type,
            'register' => $register,
            'description' => $description
        ]);
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
