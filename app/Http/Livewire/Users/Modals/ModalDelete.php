<?php

namespace App\Http\Livewire\Users\Modals;

//use Livewire\Component;

use App\Models\User;
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
        $user = User::with('roles')->where('id', $this->privilegesId)->get();
        $this->title = '¿DESEAS ELIMINAR AL USUARIO ' . $user[0]->name . ' ?';
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

        $this->notification([
            'title'       => 'USUARIO ELIMINADO CON EXITO',
            'icon'        => 'error',
            'timeout' => '3100'
        ]);

    }
    
}
