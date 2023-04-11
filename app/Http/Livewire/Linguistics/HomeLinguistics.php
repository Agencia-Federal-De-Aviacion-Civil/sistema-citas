<?php

namespace App\Http\Livewire\Linguistics;

use App\Models\Appointment\Document;
use App\Models\catalogue\headquarter;
use App\Models\catalogue\typeExam;
use App\Models\Linguistic\Linguistic;
use App\Models\Linguistic\Reserve;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class HomeLinguistics extends Component
{
    use WithFileUploads;
    public $confirmModal = false;
    public $name_document, $reference_number, $pay_date, $type_exam_id, $type_license, $license_number, $red_number, $headquarters_id, $dateReserve;
    public $exams, $headquartersQueries;
    public function rules()
    {
        return [
            'reference_number' => 'required|unique:linguistics',
            'pay_date' => 'required',
            'name_document' => 'required|mimetypes:application/pdf|max:5000',
            'type_exam_id' => 'required',
            'type_license' => 'required',
            'license_number' => 'required',
            'red_number' => 'required',
            'headquarters_id' => 'required',
            'dateReserve' => 'required'
        ];
    }
    public function mount()
    {
        $this->exams = typeExam::all();
        $this->headquartersQueries = headquarter::with('headquarterUser')
            ->where('system_id', 2)->get();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.linguistics.home-linguistics')
            ->layout('layouts.app');
    }
    public function openModal()
    {
        $this->confirmModal = true;
    }
    public function save()
    {
        $this->validate();
        // Verificar si la hora ya está ocupada
        $existingReserve = Reserve::where('dateReserve', $this->dateReserve)->first();
        if ($existingReserve) {
            $this->addError('dateReserve', 'La hora seleccionada ya está ocupada. Por favor seleccione otra.');
            return;
        }
        $saveDocument = Document::create([
            'name_document' => $this->name_document->store('documentos', 'public')
        ]);
        $saveLinguistic = Linguistic::create([
            'user_id' => Auth::user()->id,
            'reference_number' => $this->reference_number,
            'pay_date' => $this->pay_date,
            'document_id' => $saveDocument->id,
            'type_exam_id' => $this->type_exam_id,
            'type_license' => $this->type_license,
            'license_number' => $this->license_number,
            'red_number' => $this->red_number
        ]);

        Reserve::create([
            'linguistic_id' => $saveLinguistic->id,
            'headquarters_id' => $this->headquarters_id,
            'dateReserve' => $this->dateReserve,
        ]);
    }
    public function messages()
    {
        return [
            'reference_number.required' => 'Campo obligatorio',
            'reference_number.unique' => 'Referencia de pago ya existe.',
            'pay_date.required' => 'Campo obligatorio',
            'name_document.required' => 'Campo obligatorio',
            'type_exam_id.required' => 'Campo obligatorio',
            'type_license.required' => 'Campo obligatorio',
            'license_number.required' => 'Campo obligatorio',
            'red_number.required' => 'Campo obligatorio',
            'headquarters_id.required' => 'Campo obligatorio',
            'dateReserve.required' => 'Campo obligatorio',
        ];
    }
}
