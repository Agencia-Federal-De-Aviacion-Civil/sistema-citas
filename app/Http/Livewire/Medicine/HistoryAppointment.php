<?php

namespace App\Http\Livewire\Medicine;

use Livewire\Component;
use Livewire\Livewire;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class HistoryAppointment extends Component
{
    public function render()
    {
        return view('livewire.medicine.history-appointment');
    }
}
