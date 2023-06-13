<?php

namespace App\Http\Livewire\Medicine;

use App\Models\Medicine\MedicineReserve;
use Jenssegers\Date\Date;
use Livewire\Component;
use Livewire\Livewire;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class HistoryAppointment extends Component
{
    public $dateNow;
    public function mount()
    {
        Date::setLocale('es');
        $this->dateNow = Date::now()->format('l j F Y');
    }
    public function render()
    {
        return view('livewire.medicine.history-appointment');
    }
}
