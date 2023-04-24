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
    public $modal,$id_save,$name,$email,$password,$passwordConfirmation,$privileges,$privilegesId;

    public function mount($privilegesId){
        $this->privilegesId = $privilegesId;        
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
        $this->name = $privilegesId;
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
