<?php

namespace App\Http\Livewire\Medicine;

use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Jenssegers\Date\Date;

class HistoryMedicieMovements extends Component
{
    public $dateNow;
    public function render()
    {
        Date::setLocale('es');
        $this->dateNow = Date::now()->format('l j F Y');
        return view('livewire.medicine.history-medicie-movements');
    }

}