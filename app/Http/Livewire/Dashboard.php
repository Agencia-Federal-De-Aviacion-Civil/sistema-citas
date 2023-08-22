<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard');
    }
    public function goAfac($idTypeAppointment)
    {
        $currentIdType = session('idType');
        if ($currentIdType !== $idTypeAppointment) {
            session()->forget('idType');
        }
        session(['idType' => $idTypeAppointment]);
        redirect()->route('afac.medicine');
    }
}
