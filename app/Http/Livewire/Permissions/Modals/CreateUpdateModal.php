<?php

namespace App\Http\Livewire\Permissions\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Permission;

class CreateUpdateModal extends ModalComponent
{
    public $permissionId, $id_permission, $name, $description, $permissionQuery;
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
        } else {
            $this->permissionId = null; // o cualquier otro valor predeterminado que desees
        }
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
            ]
        );
        $this->closeModal();
        $this->emit('createPermissions');
        $this->reset();
    }
}