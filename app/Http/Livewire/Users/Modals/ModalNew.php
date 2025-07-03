<?php

namespace App\Http\Livewire\Users\Modals;

use App\Models\Catalogue\Headquarter;
use App\Models\Catalogue\LogsApi;
use App\Models\Catalogue\Municipal;
use App\Models\Catalogue\State;
use App\Models\User;
use App\Models\UserParticipant;
use App\Models\Medicine\medicine_history_movements;
use App\Models\UserHeadquarter;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use App\Models\InactiveUser;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Predis\Command\Redis\DUMP;

class ModalNew extends ModalComponent
{
    use Actions;
    use WithFileUploads;
    public $roles, $modal, $id_save, $id_update, $name, $email, $apParental, $apMaternal, $state_id, $municipal_id, $password, $passwordConfirmation, $privileges, $privilegesId, $title, $email_verified, $dateNow,
        $genre, $birth, $age, $street, $nInterior, $nExterior, $suburb, $postalCode, $federalEntity, $delegation, $mobilePhone, $officePhone, $extension, $curp, $states, $municipals, $municipio, $select, $user_headquarter_id,
        $headquarter_id;
    public $headquarters, $userPrivileges, $isVerified, $userstatus, $reason, $inactiveusers, $start_date, $end_date, $updatestatus;

    public $rfc_participant, $enabled, $sex_api, $formattedBirthDate, $age_participant, $rfc_participant_api, $curp_api, $sexes, $country_birth, $state_birth_participant, $nationality_participant, $countries;
    public $country_birth_participant, $rfc_company_participant, $name_company_participant, $apiStates = [], $country_id, $apiMunicipals = [], $confirm_privacity;
    public $user, $sex_id, $state_name_separated, $municipal_name_separated, $birth_years, $buttonHIden, $userparticipantid, $privilegesUserid;


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
            $this->inactiveusers = InactiveUser::where('user_id', $this->userPrivileges[0]->id)->get();
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
            $this->userstatus = $this->userPrivileges[0]->status;
            $this->updatestatus = isset($this->inactiveusers[0]->id) ? $this->inactiveusers[0]->id : '';
            $this->start_date = isset($this->inactiveusers[0]->start_date) ? $this->inactiveusers[0]->start_date : '';
            $this->end_date = isset($this->inactiveusers[0]->end_date) ? $this->inactiveusers[0]->end_date : '';
            $this->reason = isset($this->inactiveusers[0]->observation) ? $this->inactiveusers[0]->observation : '';

            $this->enabled = true;
            $this->buttonHIden = true;
            $this->rfc_participant = $this->userPrivileges->first()->id.' - SIN RFC';
        } else {
            $this->privilegesId = null;
            $buttonHIden = null;
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

                $this->genre = $this->sex_api == 'H' ? 'MASCULINO' : ($this->sex_api === 'M' ? 'FEMENINO' : ($this->sex_api === 'X' ? 3 : ''));
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
    }

    public function render()
    {
        return view('livewire.users.modals.modal-new', ['isVerified' => $this->isVerified]);
    }


    public function cleanSearch()
    {
        $this->enabled = false;
        $this->reset('curp');
        $this->clean();
    }

    public function updatedStateId($id)
    {
        $this->select = 0;
        $this->municipals = Municipal::with('municipalState')->where('state_id', $id)->get();
    }

    public function updatedprivileges($name)
    {
        if ($name == 'headquarters_authorized') {
            $this->headquarters = Headquarter::where('is_external', true)
                ->where('system_id', 1)->get();
        } else {
            $this->headquarters = Headquarter::where('is_external', false)
                ->where('system_id', 1)->get();
        }
    }
    public static function modalMaxWidth(): string
    {
        return '3xl';
    }
    public static function closeModalOnEscape(): bool
    {
        return false;
    }
    public static function closeModalOnClickAway(): bool
    {
        return false;
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
                'status' => $this->userstatus,
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

            if ($this->privileges === 'headquarters' || $this->privileges === 'sub_headquarters' || $this->privileges === 'headquarters_authorized') {
                UserHeadquarter::updateOrCreate(
                    ['id' => $this->user_headquarter_id],
                    [
                        'headquarter_id' => $this->headquarter_id,
                        'user_participant_id' => $user_participants->id
                    ]
                );
            }
            //función para inhabilitar
            if ($this->userstatus == '2') {
                //dd('entra');
                $validatedData = $this->validate([
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'reason' => 'required',
                ]);
                InactiveUser::updateOrCreate(
                    ['id' => $this->updatestatus],
                    [
                        'user_id' => $this->id_save,
                        'start_date' => $this->start_date,
                        'end_date' => $this->end_date,
                        'observation' => $this->reason,
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


        $this->privilegesUserid = $privilegesUser->id;
        $this->userparticipantid = $user_participants->id;
        $this->registerTenantUser();
        $this->closeModal();
    }


    public function registerTenantUser()
    {
        $id_state = $this->state_id ?: '7';
        $id_munis = $this->municipal_id ?: '218';
        $stateid = State::where('id', $id_state)->pluck('name')->first();
        $municipal = Municipal::where('id', $id_munis)->pluck('name')->first();
        $sex_id = $this->genre == 'MASCULINO' ? 1 : 2;
        $password = Hash::make($this->password);
        $rfc = substr($this->curp, 0, 10);
        // $birth = ($this->birth)?$this->birth:'00/00/0000';
        // dump($birth);
        // dd();

        // $birthDate = Carbon::createFromFormat('d/m/Y', $birth);
        // $formattedBirthDate = $birthDate->format('Y-m-d');
        $privileges = [
            'user' => 'medical_user',
            'headquarters' => 'medical.headquarters',
            'super_admin_medicine' => 'medical.super_admin_medicine',
            'sub_headquarters' => 'medical.sub_headquarters',
            'headquarters_authorized' => 'medical.headquarters_authorized'
        ][$this->privileges];

        if (checkdnsrr('crp.sct.gob.mx', 'A')) {
            if (!$this->id_save) {
            $endpoint = env('SIMA_API_REGISTER', null);
            $response = Http::withHeaders([
                'AuthorizationSima' => '8X4Oeq4g3puzL77UVVu1ZfNoSGZ2R5tgdZgcuLMfpRDuHMQuvyemKgftajZjGkQX',                
                    'Accept' => 'application/json'
                ])->connectTimeout(30)->post(
                    'https://siafac.afac.gob.mx/listStore?',
                    [
                        'id' => $this->privilegesUserid,
                        'name' => $this->name,
                        'email' => $this->email,
                        'password' => $password,
                        'userParticipantid' => $this->userparticipantid,
                        'sex_id' => $sex_id,
                        'country_id' => '165',
                        'lst_pat_prfle' => $this->apParental,
                        'lst_mat_prfle' => $this->apMaternal,
                        'curp_prfle' => $this->curp,
                        'rfc_prfle' => $this->rfc_participant,
                        'birth_prfle' => $this->formattedBirthDate,
                        'state_birth_prfle' => NULL,
                        'nationality_prfle' =>'MEXICANA',
                        'country_birth_prfle'=>'MÉXICO',
                        'state_prfle' => $stateid,
                        'municipality_prfle' => $municipal,
                        'location_prfle' => $this->delegation,
                        'street_prfle' => $this->street,
                        'n_int_prfle' => $this->nInterior,
                        'n_ext_prfle' => $this->nExterior,
                        'suburb_prfle' => $this->suburb,
                        'postal_cod_prfle' => $this->postalCode,
                        'mob_phone_prfle' => $this->mobilePhone,
                        'office_phone_prfle' => $this->officePhone,
                        'ext_prfle' => $this->extension,
                        'rfc_company_prfle' => NULL,
                        'name_company_prfle' => NULL,
                        'confirm_privacity' => 1,
                        'privileges' => $privileges,
                        'user_headquarter_id' => $this->user_headquarter_id,
                        'headquarter_id' => $this->headquarter_id
                    ]
                );
            } else {

                $rfc_participant = ($this->rfc_participant) ? $this->rfc_participant : $rfc ;
                $this->birth = Carbon::parse($this->birth);
                $formattedBirthDate = $this->birth->format('Y-m-d');

                $endpoint = env('SIMA_API_USERUPDATE', null);
                $response = Http::withHeaders([
                    'AuthorizationSima' => '8X4Oeq4g3puzL77UVVu1ZfNoSGZ2R5tgdZgcuLMfpRDuHMQuvyemKgftajZjGkQX',                
                    'Accept' => 'application/json'
                ])->connectTimeout(30)->put(
                    'https://siafac.afac.gob.mx/updateCita?',
                    [
                        'id_save' => $this->privilegesUserid,
                        'id_update' => $this->userparticipantid,
                        'name' => $this->name,
                        'email' => $this->email,
                        'password' => $password,
                        'sex_id' => $sex_id,
                        'country_id' => '165',
                        'lst_pat_prfle' => $this->apParental,
                        'lst_mat_prfle' => $this->apMaternal,
                        'curp_prfle' => $this->curp,
                        'rfc_prfle' => $rfc_participant,
                        'birth_prfle' => $formattedBirthDate,
                        'state_birth_prfle' => NULL,
                        'nationality_prfle' =>'MEXICANA',
                        'country_birth_prfle' =>'MÉXICO',
                        'state_prfle' => $stateid,
                        'municipality_prfle' => $municipal,
                        'location_prfle' => $this->delegation,
                        'street_prfle' => $this->street,
                        'n_int_prfle' => $this->nInterior,
                        'n_ext_prfle' => $this->nExterior,
                        'suburb_prfle' => $this->suburb,
                        'postal_cod_prfle' => $this->postalCode,
                        'mob_phone_prfle' => $this->mobilePhone,
                        'office_phone_prfle' => $this->officePhone,
                        'ext_prfle' => $this->extension,
                        'rfc_company_prfle' => NULL,
                        'name_company_prfle' => NULL,
                        'confirm_privacity' => 1,
                        'privileges' => $privileges,
                        'user_headquarter_id' => $this->user_headquarter_id,
                        'headquarter_id' => $this->headquarter_id
                    ]
                );
            }
            // https://siafac.afac.gob.mx/updateCita?
            if ($response->successful()) {
                $statesSuccess = $response->json()['data'];
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
            'start_date.required' => 'Campo obligatorio',
            'end_date.required' => 'Campo obligatorio',
            'reason.required' => 'Campo obligatorio',

            'curp.required' => 'Campo obligatorio',
            'curp.unique' => 'El curp ingresado ya se ha registrado',
            'curp.max' => 'Máximo 18 caracteres',
            'curp.min' => 'Mínimo 18 caracteres',

        ];
    }
}
