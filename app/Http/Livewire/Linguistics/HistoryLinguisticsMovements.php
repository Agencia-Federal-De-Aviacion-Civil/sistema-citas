<?php

namespace App\Http\Livewire\Linguistics;

use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Jenssegers\Date\Date;
class HistoryLinguisticsMovements extends Component
{
    public $dateNow;
    public function render()
    {
        Date::setLocale('es');
        $this->dateNow = Date::now()->format('l j F Y');
        return view('livewire.linguistics.history-linguistics-movements');
    }

}