<?php

namespace App\Http\Livewire\Appointment;

use App\Models\appointment\userAppointment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AppointmentHistory extends Component
{
    public function render()
    {
        $appointments = userAppointment::with([
            'appointmentUser', 'appointmentStudying', 'appointmentRenovation', 'appointmentSuccess',
            'appointmentTypeExam', 'appointmentDocument'
        ])
            ->where('user_id', '<>', Auth::user()->id)->get();
        return view('livewire.appointment.appointment-history', compact('appointments'))
            ->layout('layouts.app');
    }
}
