<?php

namespace App\Http\Livewire\Medicine;

use App\Models\Appointment\Document;
use App\Models\catalogue\typeExam;
use App\Models\Medicine\Medicine;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class HomeMedicine extends Component
{
    use Actions;
    use WithFileUploads;
    public $name_document, $reference_number, $pay_date, $type_exam_id;
    public $typeExams;
    public function mount()
    {
        $this->typeExams = typeExam::all();
    }
    public function rules()
    {
        return [
            'name_document' => 'required',
            'reference_number' => 'required',
            'pay_date' => 'required',
            'type_exam_id' => 'required',
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
        $this->reset([]);
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
