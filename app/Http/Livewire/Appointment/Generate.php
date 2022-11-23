<?php

namespace App\Http\Livewire\Appointment;

use App\Models\catalogue\typeClass;
use App\Models\catalogue\typeExam;
use Livewire\Component;

class Generate extends Component
{
    public $type_exam_id, $type_class_id, $aerodromos = [];
    public function mount()
    {
        $this->reset();
        $this->typeExamens = typeExam::all();
        $this->typeClasses = collect();
    }
    public function render()
    {
        return view('livewire.appointment.generate');
    }
    public function updatedtypeExamId($type_exam_id)
    {
        $this->typeClasses = typeClass::where('type_exam_id', $type_exam_id)->get();
    }
}
