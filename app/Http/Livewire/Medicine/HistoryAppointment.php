<?php

namespace App\Http\Livewire\Medicine;

use App\Models\Medicine\MedicineReserve;
use Livewire\Component;
use Livewire\Livewire;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class HistoryAppointment extends Component
{
    public function render()
    {
        $appointment = MedicineReserve::query()
        ->selectRaw("count(id) as registradas")
        ->first();
        $registradas = $appointment->registradas;
        return view('livewire.medicine.history-appointment',compact('registradas'));
    }
}
