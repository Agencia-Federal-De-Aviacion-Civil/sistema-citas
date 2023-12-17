<?php

namespace App\Http\Livewire\Permissions\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Permission;
use WireUi\Traits\Actions;

class Delete extends ModalComponent
{
    use Actions;
    public $permissionId,$permission,$namePermission;
    public function mount($permissionId)
    {
        $this->permissionId = $permissionId;
        $this->permission = Permission::where('id', $permissionId)->get();
        $this->namePermission = $this->permission[0]->name;
    }
    public function render()
    {
        return view('livewire.permissions.modals.delete');
    }
    public function delete()
    {
        Permission::findOrFail($this->permissionId)->delete();
        $this->closeModal();
        $this->emit('deletePermissions');
        $this->notification([
            'title'       => 'PERMISO ELIMINADO',
            'icon'        => 'error',
            'timeout' => '3100'
        ]);
    }
}
