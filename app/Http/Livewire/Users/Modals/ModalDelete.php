<?php

namespace App\Http\Livewire\Users\Modals;

//use Livewire\Component;

use App\Models\Catalogue\LogsApi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Jenssegers\Date\Date;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class ModalDelete extends ModalComponent
{
    use Actions;
    use WithFileUploads;
    public $privilegesId, $name, $title;
    public function mount($privilegesId)
    {
        $this->privilegesId = $privilegesId;
        $this->name = $this->privilegesId;
        $user = User::with('roles','UserParticipant')->where('id', $this->privilegesId)->get();
        // $this->title = '¿DESEAS ELIMINAR AL USUARIO ' . $user[0]->name . ' ?';
        $this->title = $user[0]->name.' '.$user[0]->UserParticipant[0]->apParental.' '.$user[0]->UserParticipant[0]->apMaternal;
    }

    public function render()
    {
        return view('livewire.users.modals.modal-delete');
    }
    public static function modalMaxWidth(): string
    {
        return 'lg';
    }
    public function delete()
    {
        $deleteUser = User::where('id', $this->privilegesId);
        $deleteUser->update([
            'status' => 1,
        ]);
        $this->emit('deleteUser');
        $this->closeModal();

        // $this->deleterUsers($this->privilegesId);

        $this->notification([
            'title'       => 'USUARIO ELIMINADO CON EXITO',
            'icon'        => 'error',
            'timeout' => '3100'
        ]);

    }

    public function deleterUsers($privilegesId)
    {

            if (checkdnsrr('crp.sct.gob.mx', 'A')) {
                // http://afac-tenant.gob/deleteUsers?
                $deleted_at = Date::now()->format('Y-m-d H:m');
                $endpoint = env('SIMA_API_USERDELETE', null);
                $response = Http::withHeaders([
                    'AuthorizationSima' => '8X4Oeq4g3puzL77UVVu1ZfNoSGZ2R5tgdZgcuLMfpRDuHMQuvyemKgftajZjGkQX',                                
                    'Accept' => 'application/json'
                ])->connectTimeout(30)->get('https://siafac.afac.gob.mx/deleteUsers?id=' . $privilegesId . '&deleted=' . $deleted_at .'');
                // https://siafac.afac.gob.mx/deleteUsers?
                if ($response->successful()) {
                    $statesSuccess = $response->json()['data'];

                } elseif ($response->successful() && $response->json()['data'] === 'NO EXITOSO') {
                    $this->clean();
                    $this->notification()->send([
                        'title'       => 'No se elimino registro!',
                        'description' => 'Usuario no eliminado.',
                        'icon'        => 'error',
                        'timeout' => '3100'
                    ]);
                } else {
                    $error = $response->json()['message'];
                    $this->LogsApi($curp_logs = Auth::user()->UserParticipant->first()->curp, $type = 'ELIMINO', $register = $error, $description = 'ERROR AL ELIMINAR USURIO');
                    // $this->notification()->send([
                    //     'icon' => 'info',
                    //     'title' => 'AVISO!',
                    //     'description' => 'ERROR',
                    //     'timeout' => '3100'
                    // ]);
                }
            } else {
                $this->notification()->send([
                    'icon' => 'info',
                    'title' => 'Sin conexión!',
                    'description' => 'No hay conexión, vuelve a intentarlo.',
                    'timeout' => '3100'
                ]);
                $this->LogsApi($curp_logs = Auth::user()->UserParticipant->first()->curp, $type = 'ELIMINAR', $register = 'SIN CONEXION', $description = 'No hay conexión, vuelve a intentarlo');
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

}
