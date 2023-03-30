<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.home.dashboard')
        ->layout('layouts.app');
    }
}
