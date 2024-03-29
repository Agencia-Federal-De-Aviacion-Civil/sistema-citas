<?php

namespace App\Http\Livewire\Linguistics;

use App\Models\Catalogue\Headquarter;
use App\Models\Catalogue\TypeExam;
use App\Models\Document;
use App\Models\Linguistic\Linguistic;
use App\Models\Linguistic\Reserve;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use Livewire\Component;
use Livewire\WithFileUploads;


class HomeLinguistics extends Component
{
    use WithFileUploads;
    public $confirmModal = false;
    public $name_document, $reference_number, $pay_date, $type_exam_id, $type_license, $license_number, $red_number, $headquarters_id, $dateReserve;
    public $exams, $headquartersQueries, $date;
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
        
        $this->exams = TypeExam::all();
        $this->headquartersQueries = Headquarter::with('headquarterUser')
            ->where('system_id', 2)->get();
            Date::setLocale('es');
            $this->dateNow = Date::now()->format('l j F Y');
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
        $extension = $this->name_document->extension();
        $saveDocument = Document::create([
            'name_document' => $this->document->storeAs('uploads/citas-app', 'prueba' .  '.' . $extension, 'do'),
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
            'reference_number.unique' => 'Referencia de pago ya existe',
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
