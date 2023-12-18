<?php

namespace App\Http\Livewire\Permissions\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Permission;

class CreateUpdateModal extends ModalComponent
{
    public $permissionId, $id_permission, $name, $description, $permissionQuery,$guard_name;
    public function rules()
    {
        return [
            'name' => 'required|unique:permissions',
            'description' => 'required'
        ];
    }
    public function mount($permissionId = null)
    {
        if (isset($permissionId)) {
            $this->permissionId = $permissionId;
            $this->permissionQuery = Permission::findOrFail($permissionId);
            $this->name = $this->permissionQuery->name;
            $this->description = $this->permissionQuery->description;
            $this->id_permission = $this->permissionQuery->id;
            $this->guard_name = $this->permissionQuery->guard_name;
        } else {
            $this->permissionId = null; // o cualquier otro valor predeterminado que desees
        }
    }
    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
    public function render()
    {
        return view('livewire.permissions.modals.create-update-modal');
    }
    public function save()
    {
        Permission::updateOrCreate(
            [
                'id' => $this->id_permission
            ],
            [
                'name' => $this->name,
                'description' => $this->description,
                'guard_name' => $this->guard_name,
            ]
        );
        $this->closeModal();
        $this->emit('createPermissions');
        $this->reset();
    }
}
