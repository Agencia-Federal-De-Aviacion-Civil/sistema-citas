<?php

namespace App\Http\Livewire\Medicine;

use App\Models\Appointment\Document;
use App\Models\catalogue\clasificationClass;
use App\Models\catalogue\headquarter;
use App\Models\catalogue\typeClass;
use App\Models\catalogue\typeExam;
use App\Models\Medicine\Medicine;
use App\Models\Medicine\MedicineInitial;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class HomeMedicine extends Component
{
    use Actions;
    use WithFileUploads;
    public $user_question_id, $type_class_id, $clasificationClass, $clasification_class_id;
    public $name_document, $reference_number, $pay_date, $type_exam_id;
    public $questionClassess, $typeExams, $sedes;
    // MEDICINE INITIAL TABLE
    public $question;
    public function mount()
    {
        $this->typeExams = typeExam::all();
        $this->sedes = headquarter::where('system_id', 1)->get();
        $this->questionClassess = collect();
        $this->clasificationClass = collect();
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
    public function updatedTypeClassId($type_class_id)
    {
        $this->clasificationClass = clasificationClass::where('type_class_id', $type_class_id)->get();
    }
    public function resetClasificationClass()
    {
        $this->clasificationClass = [];
    }
    // public function resetQuestions()
    // {
    //     $this->user_question_id = '';
    // }
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
