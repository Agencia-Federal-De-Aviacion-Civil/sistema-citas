<?php

namespace App\Http\Livewire\Linguistics;

use App\Models\Catalogue\Headquarter;
use App\Models\Catalogue\Schedule;
use App\Models\Catalogue\TypeExam;
use App\Models\Document;
use App\Models\Linguistic\Linguistic;
use App\Models\Linguistic\LinguisticReserve;
use App\Models\Linguistic\Reserve;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use Livewire\Component;
use Livewire\WithFileUploads;


class HomeLinguistics extends Component
{
    use WithFileUploads;
    public $confirmModal = false;
    public $name_document, $dateNow,$reference_number, $pay_date, $type_exam_id, $type_license, $license_number, $red_number, $to_user_headquarters, $date_reserve;
    public $exams, $headquartersQueries, $date, $schedules, $schedule_id;
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
            'date_reserve' => 'required',
            'schedule_id' => 'required'
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

    public function updatedDateReserve($value)
    {
        $this->schedules = Schedule::where('user_id', $this->to_user_headquarters)
            ->whereNotIn('id', function ($query) use ($value) {
                $query->select('schedule_id')
                    ->from('linguistic_reserves')
                    ->where('to_user_headquarters', $this->to_user_headquarters)
                    ->where('date_reserve', $value);
            })
            ->orderBy('time_start')
            ->get();
    }
    public function save()
    {
        $this->validate();
        $extension = $this->name_document->extension();
        $saveDocument = Document::create([
            'name_document' => $this->name_document->storeAs('uploads/tester', 'linguistica' .  '.' . $extension, 'do'),
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
        LinguisticReserve::create([
            'from_user_appointment' => Auth::user()->id,
            'to_user_headquarters' => $this->to_user_headquarters,
            'linguistic_id' => $saveLinguistic->id,
            'date_reserve' => $this->date_reserve,
            'schedule_id' => $this->schedule_id
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
            'date_reserve.required' => 'Campo obligatorio',
        ];
    }
}
