<?php

namespace App\Http\Livewire\Appointment;

use App\Models\appointment\userQuestion;
use App\Models\catalogue\typeClass;
use App\Models\catalogue\typeExam;
use Livewire\Component;

class Generate extends Component
{
    public $user_question_id, $finishCollegue, $type_exam_id, $type_class_id, $aerodromos = [];
    public function mount()
    {
        $this->reset();
        $this->typeExamens = typeExam::all();
        $this->questions = userQuestion::all();
        $this->typeClasses = collect();
        $this->questionClassess = collect();
    }
    public function render()
    {
        return view('livewire.appointment.generate');
    }
    public function updatedtypeExamId($type_exam_id)
    {
        $this->typeClasses = typeClass::where('type_exam_id', $type_exam_id)->get();
    }
    public function updatedUserQuestionId($user_question_id)
    {
        $this->questionClassess = typeClass::where('user_question_id', $user_question_id)->get();
    }
}
