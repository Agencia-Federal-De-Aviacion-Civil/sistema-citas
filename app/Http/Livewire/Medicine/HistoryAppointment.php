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
    public $registradas,$validado,$reagendado,$canceladas,$porconfir,$pendientes,$porpendientes,$porreagendado,$porcanceladas,$porcanceladas1,$dateNow;
    protected $listeners = ['createRequest' => 'mount'];
    public function mount()
    {
        Date::setLocale('es');
        $this->dateNow = Date::now()->format('l j F Y');

        $appointment = MedicineReserve::query()
        ->selectRaw("count(id) as registradas")
        ->selectRaw("count(case when status = '0' then 1 end) as pendientes")
        ->selectRaw("count(case when status = '1' then 1 end) as validado")
        ->selectRaw("count(case when status = '2' then 1 end) as canceladosede")
        ->selectRaw("count(case when status = '3' then 1 end) as canceladousuario")
        ->selectRaw("count(case when status = '4' then 1 end) as reagendado")
        ->first();

        $this->registradas = $appointment->registradas;
        $this->pendientes = $appointment->pendientes;
        $this->validado = $appointment->validado;
        $this->reagendado = $appointment->reagendado;
        $this->canceladas = $appointment->canceladosede+$appointment->canceladousuario;
        $this->porconfir = $appointment && $appointment->registradas > 0
            ? round(($appointment->validado * 100 / $appointment->registradas), 0)
            : 0;
            $this->porpendientes = $appointment && $appointment->registradas > 0
            ? round(($appointment->pendientes * 100 / $appointment->registradas), 0)
            : 0;
            $this->porreagendado = $appointment && $appointment->registradas > 0
            ? round(($appointment->reagendado * 100 / $appointment->registradas), 0)
            : 0;
            $this->porcanceladas1 = $appointment && $appointment->registradas > 0
            ? round(($appointment->canceladas * 100 / $appointment->registradas), 0)
            : 0;
            $this->porcanceladas = $appointment && $appointment->registradas > 0
            ? round(($appointment->canceladas * 100 / $appointment->registradas), 0)
            : 0;
    }
    public function render()
    {

        return view('livewire.medicine.history-appointment');
    }
}
