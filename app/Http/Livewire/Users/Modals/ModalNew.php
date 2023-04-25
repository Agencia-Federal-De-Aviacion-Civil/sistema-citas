<?php

namespace App\Http\Livewire\Users\Modals;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class ModalNew extends ModalComponent
{
    use Actions;
    use WithFileUploads;
    public $modal,$id_save,$name,$email,$password,$passwordConfirmation,$privileges,$privilegesId,$title;

    public function mount($privilegesId){
        $this->privilegesId = $privilegesId;
        $this->valores($privilegesId);        
    }

    public function render()
    {
        return view('livewire.users.modals.modal-new');
    }

    public function clean()
    {
        $this->reset(['name', 'email', 'password']);
    }
    public function valores($privilegesId){

        $this->privilegesId = $privilegesId;

        if($this->privilegesId!=0){
            $userPrivileges = User::with('roles')->where('id',$this->privilegesId)->get();
            $this->id_save = $userPrivileges[0] ->id;
            $this->name = $userPrivileges[0]->name;
            $this->email = $userPrivileges[0]->email;
            $this->privileges = $userPrivileges[0]->roles[0]->name;
            $this->title = 'EDITAR USUARIO';
        }else{
            $this->title = 'AGREGAR USUARIO';
        }
    }
    public function save()
    {

        $privilegesUser = User::updateOrCreate(
            ['id' => $this->id_save],
            [
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]
        )->assignRole($this->privileges);
        $this->emit('privilegesUser');            
        $this->reset([]);
        $this->notification([
            'title'       => 'USUARIO AGREGADO CON EXITO',
            'icon'        => 'success',
            'timeout' => '3100'
        ]);
        $this->emit('privilegesUser');            
        $this->closeModal();
    }
}
