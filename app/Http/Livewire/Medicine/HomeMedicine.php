<?php

namespace App\Http\Livewire\Medicine;

use App\Models\Appointment\Document;
use App\Models\appointment\userQuestion;
use App\Models\catalogue\clasificationClass;
use App\Models\catalogue\headquarter;
use App\Models\catalogue\typeClass;
use App\Models\catalogue\typeExam;
use App\Models\Medicine\Medicine;
use App\Models\Medicine\MedicineInitial;
use App\Models\Medicine\MedicineRenovation;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class HomeMedicine extends Component
{
    use Actions;
    use WithFileUploads;
    public $user_question_id, $type_class_id, $clasificationClass, $clasification_class_id;
    public $name_document, $reference_number, $pay_date, $type_exam_id, $typeRenovationExams;
    public $questionClassess, $typeExams, $sedes, $userQuestions, $to_user_headquarters, $dateReserve, $user;
    // MEDICINE INITIAL TABLE
    public $question;
    public function mount()
    {
        $this->typeExams = typeExam::all();
        $this->sedes = headquarter::where('system_id', 1)->get();
        $this->userQuestions = userQuestion::all();
        $this->questionClassess = collect();
        $this->clasificationClass = collect();
        $this->typeRenovationExams = collect();
    }
    public function rules()
    {
        return [
            'name_document' => 'required',
            'reference_number' => 'required',
            'pay_date' => 'required',
            'type_exam_id' => 'required',
            'user_question_id' => 'required_if:type_exam_id,1',
            'type_class_id' => '',
            'clasification_class_id' => '',
            'to_user_headquarters' => 'required',
            'dateReserve' => 'required'
        ];
    }
    public function render()
    {
        return view('livewire.medicine.home-medicine')
            ->layout('layouts.app');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function clean()
    {
        $this->reset([
            'name_document',
            'reference_number',
            'pay_date',
            'type_exam_id',
            'user_question_id',
            'type_class_id',
            'clasification_class_id',
            'user_question_id',
        ]);
    }
    public function updatedUserQuestionId($user_question_id)
    {
        $this->questionClassess = typeClass::where('user_question_id', $user_question_id)->get();
    }
    public function updatedTypeExamId($type_exam_id)
    {
        $this->typeRenovationExams = typeClass::where('type_exam_id', $type_exam_id)->get();
    }
    public function updatedTypeClassId($type_class_id)
    {
        $this->clasificationClass = clasificationClass::where('type_class_id', $type_class_id)->get();
    }
    public function resetClasificationClass()
    {
        $this->clasificationClass = [];
    }
    public function resetQuestions()
    {
        $this->user_question_id = [];
        // $this->dispatchBrowserEvent('reset-select-question');
    }
    public function save()
    {
        $this->validate();
        $saveDocument = Document::create([
            'name_document' => $this->name_document->store('documentos', 'public')
        ]);
        $saveMedicine = Medicine::create([
            'user_id' => Auth::user()->id,
            'reference_number' => $this->reference_number,
            'pay_date' => $this->pay_date,
            'document_id' => $saveDocument->id,
            'type_exam_id' => $this->type_exam_id
        ]);
        if ($this->type_exam_id == 1) {
            $clasification_class_ids = $this->clasification_class_id;
            if (is_array($clasification_class_ids)) {
                foreach ($clasification_class_ids as $clasifications) {
                    MedicineInitial::create([
                        'medicine_id' => $saveMedicine->id,
                        'user_question_id' => $this->user_question_id,
                        'type_class_id' => $this->type_class_id,
                        'clasification_class_id' => $clasifications
                    ]);
                }
            } else {
                MedicineInitial::create([
                    'medicine_id' => $saveMedicine->id,
                    'user_question_id' => $this->user_question_id,
                    'type_class_id' => $this->type_class_id,
                    'clasification_class_id' => $clasification_class_ids
                ]);
            }
        } else if ($this->type_exam_id == 2) {
            foreach ($this->clasification_class_id as $clasifications) {
                MedicineRenovation::create([
                    'medicine_id' => $saveMedicine->id,
                    'type_class_id' => $this->type_class_id,
                    'clasification_class_id' => $clasifications
                ]);
            }
        }
        $citas = MedicineReserve::where('to_user_headquarters', $this->to_user_headquarters)
            ->where('dateReserve', $this->dateReserve)
            ->count();
        switch ($this->to_user_headquarters) {
            case 2: // Cancun
            case 3: // Ciudad de México
                $maxCitas = 5;
                break;
            case 4: // Guadalajara
                $maxCitas = 20;
                break;
            case 1: // Tijuana
            case 3: // Monterrey
            case 6: // Toluca
                $maxCitas = 10;
                break;
            default:
                $maxCitas = 0;
                break;
        }
        if ($citas >= $maxCitas) {
            $this->notification([
                'title'       => 'ERROR DE CITA!',
                'description' => 'No hay citas disponibles para ese dia',
                'icon'        => 'error'
            ]);
        } else {
            $cita = new MedicineReserve();
            $cita->to_user_headquarters = $this->to_user_headquarters;
            $cita->dateReserve = $this->dateReserve;
            $cita->save();
            $this->notification([
                'title'       => 'CITA GENERADA',
                'description' => 'SE HA GENERADO LA CITA EXITOSAMENTE',
                'icon'        => 'success'
            ]);
        }
        $this->clean();
    }

    public function messages()
    {
        return [
            'type_exam_id.required' => 'Campo obligatorio',
            'type_class_id.required' => 'Campo obligatorio',
            'clasification_class_id.required' => 'Campo obligatorio',
            'paymentConcept.required' => 'Ingrese clave de pago.',
            'paymentConcept.unique' => 'Concepto de pago ya registrado, intenta con otro.',
            'paymentDate.required' => 'Campo obligatorio.',
            'document.required' => 'Documento obligatorio.',
            'document.mimetypes' => 'Solo documentos .PDF.',
            'document.max' => 'No permitido, tamaño maximo 500 KB',
        ];
    }
}
