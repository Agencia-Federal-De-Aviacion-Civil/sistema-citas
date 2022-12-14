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
use Carbon\Carbon;
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
    public $user_appointment_success_id, $count, $user_appointment_id, $user_question_id, $type_class_id, $clasification_class_id = [];

    public $headquarter_id, $appointmentDate, $appointmentTime, $appointments, $finishCollegue, $aerodromos = [];
    public function mount()
    {
        $this->reset();
        $this->typeExamens = typeExam::all();
        $this->questions = userQuestion::all();
        $this->sedes = headquarter::all();
        $this->typeClasses = collect();
        $this->questionClassess = collect();
        $this->clasificationClass = collect();

        // $todayDate = Carbon::now()->format('Y-m-d');
        $this->var = user_appointment_success::where('appointmentDate', $this->appointmentDate)->get();
        //  where('appointmentDate', $this->appointmentDate)
        // ->where('appointmentTime', $this->appointmentTime)
        // ->where('headquarter_id', $this->headquarter_id)

        // ->first();



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
            'appointmentTime' => 'required',
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
        $this->validate();
        // ALGORITMIC ANGEL
        $user_appointment = user_appointment_success::where('appointmentDate', $this->appointmentDate)
            ->where('appointmentTime', $this->appointmentTime)
            ->where('headquarter_id', $this->headquarter_id)
            ->first();
        if ($user_appointment == null) {
            $this->id_user_appointment = 0;
            $this->count = 1;
        } else {
            if ($user_appointment->appointmentTime <= '08:00:00' && $user_appointment->appointments == 50) {
                //dd('13 citas');
                return $this->dialog()->show([
                    'title' => 'Citas no disponibles en la fecha indicada',
                    'icon'        => 'warning'
                ]);
            } else
            if ($user_appointment->appointmentTime > '08:00:00' && $user_appointment->appointments == 50) {
                //dd('12 citas');
                return $this->dialog()->show([
                    'title' => 'Citas no disponibles en la fecha indicada',
                    'icon'        => 'warning'
                ]);
            }

            $this->id_user_appointment = $user_appointment->id;
            $this->count = $user_appointment->appointments + 1;
        }
        $this->userappointment = user_appointment_success::updateOrCreate(
            ['id' => $this->id_user_appointment],
            [
                'headquarter_id' => $this->headquarter_id,
                'appointmentDate' => $this->appointmentDate,
                'appointmentTime' => $this->appointmentTime,
                'appointments' => $this->count,
            ]
        );
        $documentPay = userPaymentDocument::updateOrCreate(
            ['id' => $this->document_id],
            ['document' => $this->document->store('documentos', 'public')]
        );
        $user_id = Auth::user()->id;
        $this->userAppointment = userAppointment::updateOrCreate(
            [
                'user_id' => $user_id,
                'user_appointment_success_id' => $this->userappointment->id,
                'type_exam_id' => $this->type_exam_id,
                'user_payment_document_id' => $documentPay->id,
                'paymentConcept' => $this->paymentConcept,
                'paymentDate' => $this->paymentDate,
                'state' => $this->state = false,
            ]
        );
        if ($this->type_exam_id == 1 && $this->user_question_id == 1) {
            userStudying::updateOrCreate([
                'user_appointment_id' => $this->userAppointment->id,
                'user_question_id' => $this->user_question_id,
                'type_class_id' => $this->type_class_id,
                'clasification_class_id' => $this->clasification_class_id,
            ]);
        } else if ($this->type_exam_id == 1 && $this->user_question_id == 2) {
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
        $this->clean();
        $this->openConfirm();
    }
    public function deleteRelationShip()
    {
        $this->confirmModal = false;
        $this->dialog()->confirm([
            'title'       => '??ATENCI??N!',
            'description' => '??ESTAS SEGURO DE ELIMINAR ESTA CITA?',
            'icon'        => 'info',
            'accept'      => [
                'label'  => 'SI',
                'method' => 'saveDelete',
            ],
            'reject' => [
                'label'  => 'NO',
                'method' => 'openModal',
            ],
        ]);
    }
    public function openModal()
    {
        $this->confirmModal = true;
    }
    public function deleteAppointment($idDelete)
    {
        $appointmentDelete = userAppointment::findOrFail($idDelete);
        $this->id_appointmentDelete = $idDelete;
        $this->state = $appointmentDelete->state;
        $this->deleteRelationShip();
    }
    public function saveDelete()
    {
        $delete = userAppointment::find($this->id_appointmentDelete);
        $delete->update(
            [
                'id' => $this->id_appointmentDelete,
                'state' => $this->state = true
            ]
        );
        $this->notification([
            'title'       => 'Cita eliminada ??xitosamente',
            'icon'        => 'error'
        ]);
    }
    public function openConfirm()
    {
        // GENERAL QUERY
        $this->appointmentInfo = userAppointment::with(['appointmentTypeExam', 'appointmentStudying', 'appointmentRenovation', 'appointmentSuccess'])
            ->where('id', $this->userAppointment->id)->get();
        // LICENSE QUERY RENOVATIONS
        $this->typeStudyings = userStudying::with(['studyingAppointment', 'studyingClasification'])
            ->where('user_appointment_id', $this->userAppointment->id)->get();
        $this->typeRenovations = userRenovation::with(['renovationAppointment', 'renovationClasification'])->where('user_appointment_id', $this->userAppointment->id)->get();
        $this->confirmModal = true;
    }
    public function closeModalFinish()
    {
        $this->confirmModal = false;
        $this->takeClass();
    }
    public function takeClass()
    {
        $this->dialog()->confirm([
            'title'       => 'CITA GENERADA',
            'description' => '??DESEAS IMPRIMIR TU ACUSE?',
            'icon'        => 'success',
            'accept'      => [
                'label'  => 'IMPRIMIR',
                'method' => 'print',
            ],
            'reject' => [
                'label'  => 'SALIR',
                'method' => 'returnView',
            ],
        ]);
    }
    public function print()
    {

        return redirect()->route('download');
    }
    public function returnView()
    {
        return redirect()->route('afac.home');
    }
    public function test()
    {
        // generate PDF
        $user_id = Auth::user()->id;
        $printQuery = userAppointment::with(['appointmentTypeExam', 'appointmentStudying', 'appointmentRenovation', 'appointmentSuccess'])
            ->where('user_id', $user_id)->latest()->first();
        // sumando las citas
        $sumappointment = user_appointment_success::where('appointmentDate', $printQuery->appointmentSuccess->appointmentDate)
            ->sum('appointments');
        if ($printQuery->type_exam_id == 1) {
            $pdf = PDF::loadView('livewire.appointment.documents.appointment-pdf', compact('printQuery', 'sumappointment'));
            return $pdf->download($printQuery->paymentDate . '-' . $printQuery->appointmentTypeExam->name . ' cita.pdf');
        } else if ($printQuery->type_exam_id == 2) {
            $pdf = PDF::loadView('livewire.appointment.documents.appointment-pdf2', compact('printQuery', 'sumappointment'));
            return $pdf->download($printQuery->paymentDate . '-' . $printQuery->appointmentTypeExam->name . ' cita.pdf');
        }
    }
    public function messages()
    {
        return ['paymentConcept.required' => 'Ingrese clave de pago.'];
    }
}
