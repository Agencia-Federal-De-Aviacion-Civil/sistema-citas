<?php

namespace App\Http\Livewire\Medicine;

use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class HistoryMovements extends Component
{

    public function render()
    {
        return view('livewire.medicine.history-movements');
    }

}