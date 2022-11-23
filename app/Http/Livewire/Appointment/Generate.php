<?php

namespace App\Http\Livewire\Appointment;

use App\Models\catalogue\typeExam;
use Livewire\Component;

class Generate extends Component
{
    public function mount()
    {
        $this->typeExamens = typeExam::all();
        $this->typeClasses = collect();
    }
    public function render()
    {
        return view('livewire.appointment.generate');
    }
    public function updated(){
        
    }
}
