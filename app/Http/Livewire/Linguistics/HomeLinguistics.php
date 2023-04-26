<?php

namespace App\Http\Livewire\Linguistics;

use App\Models\Catalogue\Headquarter;
use App\Models\Catalogue\Schedule;
use App\Models\Catalogue\TypeExam;
use App\Models\Document;
use App\Models\Linguistic\Linguistic;
use App\Models\Linguistic\Reserve;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Livewire\Component;
use Livewire\WithFileUploads;

class HomeLinguistics extends Component
{
    use WithFileUploads;
    public $confirmModal = false;
    public $name_document, $reference_number, $pay_date, $type_exam_id, $type_license, $license_number, $red_number, $to_user_headquarters, $dateReserve;
    public $exams, $headquartersQueries, $date, $schedules;
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
            'to_user_headquarters' => 'required',
            'dateReserve' => 'required'
        ];
    }
    public function mount()
    {
        $this->exams = TypeExam::all();
        $this->headquartersQueries = Headquarter::where('system_id', 2)->get();
        Date::setLocale('ES');
        $this->date = Date::now()->parse();
        $this->schedules = collect();
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
    public function updatedToUserHeadquarters($value)
    {
        // Obtener los horarios disponibles para la fecha especificada
        $this->schedules = Schedule::where('user_id', $value)
            ->where('system_id', 2)
            // ->whereNotIn('id', function ($query) {
            //     // Subconsulta para obtener los horarios reservados
            //     $query->select('medicine_schedule_id')
            //         ->from('medicine_reserves')
            //         ->where('dateReserve', $this->dateReserve)
            //         ->groupBy('medicine_schedule_id')
            //         ->havingRaw('COUNT(*) >= max_schedules');
            // })
            ->get();
    }
    public function save()
    {
        $this->validate();
        $existingReserve = Reserve::where('dateReserve', $this->dateReserve)->first();
        if ($existingReserve) {
            $this->addError('dateReserve', 'La hora seleccionada ya está ocupada. Por favor seleccione otra.');
            return;
        }
        $extension = $this->name_document->extension();
        $saveDocument = Document::create([
            'name_document' => $this->name_document->storeAs('uploads/citas-app', 'linguistica' .  '.' . $extension, 'do'),
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
            'to_user_headquarters' => $this->to_user_headquarters,
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
            'to_user_headquarters.required' => 'Campo obligatorio',
            'dateReserve.required' => 'Campo obligatorio',
        ];
    }
}
