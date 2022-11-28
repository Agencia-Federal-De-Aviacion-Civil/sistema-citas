<?php

namespace App\Http\Livewire\Appointment;

use App\Models\appointment\userAppointment;
use App\Models\appointment\userData;
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
    public function clean()
    {
        $this->reset(['type_exam_id', 'user_question_id', 'type_class_id', 'clasification_class_id', 'paymentConcept']);
    }
    public function save()
    {
        $this->validate();
        $user_id = Auth::user()->id;

        $fecha = Carbon::parse($this->date)->format('Y-m-d h:i');

        $user_data = userData::where('data', $fecha)
        ->where('headquarter_id',$this->sede)
        ->first();

        if($user_data==null){
        userData::Create([
        'headquarter_id' => $this->sede,
        'data' => $fecha,
        'count' => 1,
        ]);
        }else{

        $data = userData::find($user_data->id); 
        $count = $user_data->count + 1;
        $data->update([
        'headquarter_id' => $this->sede,
        'data' => $fecha,
        'count' => $count,
        ]);    

            // $NewRegister->procedures_lease()->update([
            //     'new_procedure_id' =>  $this->register_id,
            //     'tipBien' => $this->tipBien,
            //     'descUse' => $this->descUse,
            //     'features' => $this->features,
            //     'tarifa' => $this->tarifa,
            //     'moneda' => $this->moneda,
            //     'facCobro' => $this->facCobro,
            //     'iniVigencia' => $this->iniVigencia,
            //     'observaciones' => $this->observaciones
            // ]);

        }
        
        $this->userAppointment = userAppointment::updateOrCreate(
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
                'user_appointment_id' => $this->userAppointment->id,
                'user_question_id' => $this->user_question_id,
                'type_class_id' => $this->type_class_id,
                'clasification_class_id' => $this->clasification_class_id,
            ]);
        } else if ($this->type_exam_id == 2) {
            userRenovation::updateOrCreate([
                'user_appointment_id' => $this->userAppointment->id,
                'type_class_id' => $this->type_class_id,
                'clasification_class_id' => $this->clasification_class_id,
            ]);
        }

        $this->clean();
        $this->openConfirm();
    }
    public function openConfirm()
    {
        $this->appointmentInfo = userAppointment::with(['appointmentTypeExam', 'appointmentStudying', 'appointmentRenovation'])
            ->where('id', $this->userAppointment->id)->get();
        $this->confirmModal = true;
    }
    public function closeModalFinish()
    {
        $this->confirmModal = false;
        $this->notification([
            'title'       => 'Cita generada éxitosamente',
            'description' => 'Para mas detalles visita el apartado de citas.',
            'icon'        => 'success'
        ]);
    }
    // public function cancelSave()
    // {
    //     $this->clean();
    //     $this->closeModal();
    //     $this->notification([
    //         'title'       => 'Datos no guardados!',
    //         'description' => 'Se ha cancelado la cita.',
    //         'icon'        => 'error'
    //     ]);
    // }
    public function messages()
    {
        return ['paymentConcept.required' => 'Ingrese clave de pago.'];
    }
}
