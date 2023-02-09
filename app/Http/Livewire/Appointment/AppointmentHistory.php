<?php

namespace App\Http\Livewire\Appointment;

use Livewire\Component;

class AppointmentHistory extends Component
{
    public function render()
    {
        return view('livewire.appointment.appointment-history')
        ->layout('layouts.app');
    }
}
