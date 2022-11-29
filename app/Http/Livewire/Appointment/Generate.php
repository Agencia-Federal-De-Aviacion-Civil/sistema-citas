<?php

namespace App\Http\Livewire\Appointment;

use App\Models\appointment\user_appointment_success;
use App\Models\appointment\userAppointment;
use App\Models\appointment\userPaymentDocument;
use App\Models\appointment\userQuestion;
use App\Models\appointment\userRenovation;
use App\Models\appointment\userStudying;
use App\Models\catalogue\clasificationClass;
use App\Models\catalogue\headquarter;
use App\Models\catalogue\typeClass;
use App\Models\catalogue\typeExam;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use PDF;

class Generate extends Component
{
    use Actions;
    use WithFileUploads;
    public $confirmModal = false;
    // FIRST TABLE//
    public $id_success, $user_id, $type_exam_id, $user_payment_document_id, $document_id, $document, $paymentConcept, $paymentDate, $state;
    // QUESTION STUDYING
    public $user_appointment_id, $user_question_id, $type_class_id, $clasification_class_id = [];

    public $headquarter_id, $appointmentDate, $appointments, $finishCollegue, $aerodromos = [];
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
            'paymentDate' => 'required',
            'document' => 'required|mimetypes:application/pdf',
            'headquarter_id' => 'required',
            'appointmentDate' => 'required',
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
        $this->reset(['user_question_id', 'type_class_id', 'clasification_class_id', 'headquarter_id', 'appointmentDate']);
    }
    public function updatedUserQuestionId($user_question_id)
    {
        $this->questionClassess = typeClass::where('user_question_id', $user_question_id)->get();
    }
    public function updatedTypeClassId($type_class_id)
    {
        $this->clasificationClass = clasificationClass::where('type_class_id', $type_class_id)->get();
        $this->reset(['clasification_class_id']);
    }
    public function clean()
    {
        $this->reset(['type_exam_id', 'user_question_id', 'type_class_id', 'clasification_class_id', 'paymentConcept', 'paymentDate', 'document']);
    }
    public function save()
    {
        // if ($this->appointments != 1) {
        //     $this->dialog()->error(
        //         $title = 'Error !!!',
        //         $description = 'Your profile was not saved'
        //     );
        // } else {
        $this->validate();
        $documentPay = userPaymentDocument::updateOrCreate(
            ['id' => $this->document_id],
            ['document' => $this->document->store('documentos', 'public')]
        );
        $user_id = Auth::user()->id;
        $this->userAppointment = userAppointment::updateOrCreate(
            [
                'user_id' => $user_id,
                'type_exam_id' => $this->type_exam_id,
                'user_payment_document_id' => $documentPay->id,
                'paymentConcept' => $this->paymentConcept,
                'paymentDate' => $this->paymentDate,
                'state' => $this->state = false,
            ]
        );
        if ($this->type_exam_id == 1) {
            foreach ($this->clasification_class_id as $clasifications) {
                userStudying::updateOrCreate([
                    'user_appointment_id' => $this->userAppointment->id,
                    'user_question_id' => $this->user_question_id,
                    'type_class_id' => $this->type_class_id,
                    'clasification_class_id' => $clasifications,
                ]);
            }
        } else if ($this->type_exam_id == 2) {
            foreach ($this->clasification_class_id as $clasifications) {
                userRenovation::updateOrCreate([
                    'user_appointment_id' => $this->userAppointment->id,
                    'type_class_id' => $this->type_class_id,
                    'clasification_class_id' => $clasifications,
                ]);
            }
        }
        user_appointment_success::updateOrCreate(
            ['id' => $this->id_success],
            [
                'user_appointment_id' => $this->userAppointment->id,
                'headquarter_id' => $this->headquarter_id,
                'appointmentDate' => $this->appointmentDate,
                'appointments' => 1,
            ]
        );
        $this->clean();
        $this->openConfirm();
        // }
    }
    public function openConfirm()
    {
        // GENERAL QUERY
        $this->appointmentInfo = userAppointment::with(['appointmentTypeExam', 'appointmentStudying', 'appointmentRenovation', 'appointmentSuccess'])
            ->where('id', $this->userAppointment->id)->get();
        // LICENSE QUERY STUDYING
        $this->typeLicenses = userStudying::with(['studyingAppointment','studyingClasification'])->where('user_appointment_id',$this->userAppointment->id)->get();
        // LICENSE QUERY RENOVATIONS
        $this->typeRenovations = userRenovation::with(['renovationAppointment','renovationClasification'])->where('user_appointment_id',$this->userAppointment->id)->get();

        $Query = $this->appointmentInfo[0]->appointmentSuccess[0]->appointmentDate;
        $this->key = explode(' ', $Query);
        $this->confirmModal = true;
    }
    public function closeModalFinish()
    {
        $this->confirmModal = false;
        $this->takeClass();
    }
    public function takeClass(){
        $this->dialog()->confirm([
            'title'       => 'CITA GENERADA',
            'description' => '¿DESEAS IMPRIMIR TU ACUSE?',
            'icon'        => 'success',
            'accept'      => [
                'label'  => 'IMPRIMIR',
                'method' => 'print',
                'params' => 'Saved',
            ],
            'reject' => [
                'label'  => 'SALIR',
                'method' => '',
            ],
        ]);

    }
    public function print(){
        return redirect()->route('download');
    }
    public function test()
    {
        $user_id = Auth::user()->id;
        $userAppointment = userAppointment::with(['appointmentTypeExam', 'appointmentStudying', 'appointmentRenovation', 'appointmentSuccess'])
            ->where('user_id', $user_id)->latest()->first();
        $Query = $userAppointment->appointmentSuccess[0]->appointmentDate;
        $key = explode(' ', $Query);
        $pdf = PDF::loadView('afac.pdf.acuse', compact('userAppointment','key'));
        return $pdf->download('acuse.pdf');
    }
    public function messages()
    {
        return ['paymentConcept.required' => 'Ingrese clave de pago.'];
    }
}
