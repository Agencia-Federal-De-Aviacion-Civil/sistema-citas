<?php

namespace App\Http\Livewire\Helpsheet;

use Livewire\Component;
use WireUi\Traits\Actions;

class HomeHelpsheet extends Component
{
    use Actions;
    public function render()
    {
        return view('livewire.helpsheet.home-helpsheet')
        ->layout('layouts.app');;
    }
    
}
