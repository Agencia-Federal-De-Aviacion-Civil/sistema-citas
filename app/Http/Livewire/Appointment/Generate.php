<?php

namespace App\Http\Livewire\Appointment;

use App\Models\appointment\userAppointment;
use App\Models\appointment\userQuestion;
use App\Models\appointment\userRenovation;
use App\Models\appointment\userStudying;
use App\Models\catalogue\clasificationClass;
use App\Models\catalogue\headquarter;
use App\Models\catalogue\typeClass;
use App\Models\catalogue\typeExam;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class Generate extends Component
{
    use Actions;
    public $confirmModal = false;
    // FIRST TABLE//
    public $id_appointment, $user_id, $type_exam_id, $paymentConcept, $state;
    // QUESTION STUDYING
    public $user_appointment_id, $user_question_id, $type_class_id, $clasification_class_id;

    public $sede, $date, $finishCollegue, $aerodromos = [];
    public function mount()
    {
        $this->reset();
        $this->typeExamens = typeExam::all();
        $this->questions = userQuestion::all();
        $this->sedes = headquarter::all();
        $this->typeClasses = collect();
        $this->questionClassess = collect();
        $this->clasificationClass = collect();
    }
    public function rules()
    {
        return [
            'type_exam_id' => 'required',
            'user_question_id' => 'required_unless:type_exam_id,2',
            'type_class_id' => 'required',
            'clasification_class_id' => 'required',
            'paymentConcept' => 'required',
        ];
    }
    public function render()
    {
        return view('livewire.appointment.generate');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function updatedtypeExamId($type_exam_id)
    {
        $this->typeClasses = typeClass::where('type_exam_id', $type_exam_id)->get();
        $this->reset(['user_question_id', 'type_class_id', 'clasification_class_id', 'sede', 'date']);
    }
    public function updatedUserQuestionId($user_question_id)
    {
        $this->questionClassess = typeClass::where('user_question_id', $user_question_id)->get();
    }
    public function updatedTypeClassId($type_class_id)
    {
        $this->clasificationClass = clasificationClass::where('type_class_id', $type_class_id)->get();
    }
    public function openConfirm()
    {
        $this->confirmModal = true;
    }
    public function closeModal()
    {
        $this->confirmModal = false;
    }
    public function clean()
    {
        $this->reset(['type_exam_id', 'user_question_id', 'type_class_id', 'clasification_class_id','paymentConcept']);
    }
    public function save()
    {
        $this->validate();
        $user_id = Auth::user()->id;
        $userAppointment = userAppointment::updateOrCreate(
            ['id' => $this->id_appointment],
            [
                'user_id' => $user_id,
                'type_exam_id' => $this->type_exam_id,
                'paymentConcept' => $this->paymentConcept,
                'state' => $this->state = false,
            ]
        );
        if ($this->type_exam_id == 1) {
            userStudying::updateOrCreate([
                'user_appointment_id' => $userAppointment->id,
                'user_question_id' => $this->user_question_id,
                'type_class_id' => $this->type_class_id,
                'clasification_class_id' => $this->clasification_class_id,
            ]);
        } else if ($this->type_exam_id == 2) {
            userRenovation::updateOrCreate([
                'user_appointment_id' => $userAppointment->id,
                'type_class_id' => $this->type_class_id,
                'clasification_class_id' => $this->clasification_class_id,
            ]);
        }
        $this->notification([
            'title'       => 'Cita generada exitosamente!',
            // 'description' => 'No olvides llegar en tiempo y forma al lugar asignado.',
            'icon'        => 'success'
        ]);
        $this->clean();
        $this->closeModal();
    }
    public function cancelSave()
    {
        $this->clean();
        $this->closeModal();
        $this->notification([
            'title'       => 'Datos no guardados!',
            'description' => 'Se ha cancelado la cita.',
            'icon'        => 'error'
        ]);
    }
    public function messages(){
        return ['paymentConcept.required'=>'Ingrese clave de pago.'];
    }
}
