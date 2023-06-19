<?php

namespace App\Http\Livewire\Linguistics;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class AppointmentLinguistics extends Component
{

    public function render()
    {
        return view('livewire.linguistics.appointment-linguistics');
    }
}
