<?php

namespace App\Http\Livewire\Permissions;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    public function render()
    {
        $permissions = Permission::all();
        return view('livewire.permissions.index', compact('permissions'));
    }
   
}
