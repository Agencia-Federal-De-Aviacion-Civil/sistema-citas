<?php

namespace App\Http\Livewire\Linguistics;

use App\Models\Catalogue\Headquarter;
use App\Models\Catalogue\Schedule;
use App\Models\Catalogue\TypeExam;
use App\Models\Catalogue\TypeLicense;
use App\Models\Linguistic\Linguistic;
use App\Models\Linguistic\LinguisticReserve;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Jenssegers\Date\Date;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use PDF;



class HomeLinguistics extends Component
{
    use Actions;
    use WithFileUploads;
    public $confirmModal = false,$modal = false;
    public $name_document, $dateNow,$reference_number, $pay_date, $type_exam_id, $type_license, $license_number, $red_number, $to_user_headquarters, $date_reserve,$dateConvertedFormatted;
    public $exams,$licens, $headquartersQueries, $date, $schedules, $schedule_id,$linguisticReserves,$saveLinguistic,$cita,$id_linguisticReserve,$idLinguistic;
    public function mount()
    {

        Date::setLocale('es');
        $this->dateNow = Date::now()->format('l j F Y');
        $this->exams = TypeExam::all();
        $this->licens = TypeLicense::all();
        $this->headquartersQueries = Headquarter::where('system_id', 2)->where('status', false)->get();
        $this->schedules = collect();

    }
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

    public function render()
    {
        return view('livewire.linguistics.home-linguistics')
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
            'license_number',
            'red_number',
            'to_user_headquarters',
            'date_reserve'
        ]);
    }

    public function openModal()
    {
        $this->confirmModal = true;
    }

    public function openModalPdf()
    {
        $this->confirmModal = false;
        $this->modal = true;
    }
    public function returnDashboard()
    {
        return redirect()->route('afac.home');
    }
    public function downloadpdf()
    {
        return response()->download(public_path('documents/Formatos_Cita_lingüistica.pdf'));
    }

    public function save()
    {
        $this->validate();
        $extension = $this->name_document->getClientOriginalExtension();
        $fileName = $this->reference_number . '-' . $this->pay_date . '.' . $extension;
        $saveDocument = Document::create([
        'name_document' => $this->name_document->storeAs('documentos/linguistic', $fileName, 'public'),
        ]);



        $this->saveLinguistic = Linguistic::create([
            'user_id' => Auth::user()->id,
            'reference_number' => $this->reference_number,
            'pay_date' => $this->pay_date,
            'document_id' => $saveDocument->id,
            'type_exam_id' => $this->type_exam_id,
            'type_license_id' => $this->type_license,
            'license_number' => $this->license_number,
            'red_number' => $this->red_number
        ]);
        LinguisticReserve::create([
            'from_user_appointment' => Auth::user()->id,
            'to_user_headquarters' => $this->to_user_headquarters,
            'linguistic_id' => $this->saveLinguistic->id,
            'date_reserve' => $this->date_reserve,
            'schedule_id' => $this->schedule_id
        ]);
        $cita = new LinguisticReserve();
        $cita->from_user_appointment = Auth::user()->id;
        $cita->linguistic_id = $this->saveLinguistic->id;
        $cita->to_user_headquarters = $this->to_user_headquarters;
        $cita->date_reserve = $this->date_reserve;
        $cita->schedule_id = $this->schedule_id;
        session(['saved_linguistic_id' => $this->saveLinguistic->id]);
        $this->generatePdf();
        $this->clean();
        $this->openConfirm();
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

    public function openConfirm()
    {
        $this->linguisticReserves = LinguisticReserve::with(['linguisticReserve', 'linguisticReserveSchedule','linguisticUserHeadquers'])
            ->where('linguistic_id', $this->saveLinguistic->id)->get();
        $dateConverted = $this->linguisticReserves[0]->date_reserve;
        $this->dateConvertedFormatted = Date::parse($dateConverted)->format('l j F Y');
        $this->confirmModal = true;
        //dd($this->linguisticReserves[0]->date_reserve);
    }


    public function generatePdf()
    {
        $savedLinguisticId = session('saved_linguistic_id');
        $linguisticReserves = LinguisticReserve::with(['linguisticReserve', 'linguisticReserveSchedule','linguisticUserHeadquers'])
            ->where('linguistic_id', $savedLinguisticId)->get();
        $linguisticId = $linguisticReserves[0]->id;
        $dateAppointment = $linguisticReserves[0]->date_reserve;
        $dateConvertedFormatted = Date::parse($dateAppointment)->format('l j F Y');
        $curp = $linguisticReserves[0]->linguisticReserve->linguisticUser->userParticipant->pluck('curp')->first();
        $keyEncrypt =  Crypt::encryptString($linguisticId . '*' . $dateAppointment . '*' . $curp);
        $fileName =  $linguisticReserves[0]->date_reserve . '-' . $curp . '-' . 'LINGUISTIC-' . $linguisticId . '.pdf';
            $pdf = PDF::loadView('livewire.linguistics.documents.linguistic-initial', compact('linguisticReserves', 'keyEncrypt', 'dateConvertedFormatted','linguisticId'));
            return $pdf->download($fileName);

    }

    public function delete($idUpdate)
    {
        LinguisticReserve::find($idUpdate);
        $savedLinguisticId = session('saved_linguistic_id');
        Linguistic::find($savedLinguisticId);
        $this->id_linguisticReserve = $idUpdate;
        $this->idLinguistic = $savedLinguisticId;
        $this->deleteRelationShip();
    }
    public function deleteRelationShip()
    {
        $this->confirmModal = false;
        $this->dialog()->confirm([
            'title'       => '¡ATENCIÓN!',
            'description' => '¿ESTAS SEGURO DE CANCELAR ESTA CITA?',
            'icon'        => 'info',
            'accept'      => [
                'label'  => 'SI',
                'method' => 'confirmDelete',
            ],
            'reject' => [
                'label'  => 'NO',
                'method' => 'openModal',
            ],
        ]);
    }
    public function confirmDelete()
    {
        $updateReserve = LinguisticReserve::find($this->id_linguisticReserve);
        $updateReserve->update([
            'status' => 3
        ]);
        $updateReservePay = Linguistic::find($this->idLinguistic);
        $updateReservePay->update([
            'reference_number' => "CANCELADO" . '-' . $this->idLinguistic
        ]);
        $this->notification([
            'title'       => 'CITA CANCELADA ÉXITOSAMENTE',
            'icon'        => 'error',
            'timeout' => '3100'
        ]);
    }

//DESCARGA DE DOCUMENTO
    public function download($scheduleId)
    {
        $linguisticReserves = LinguisticReserve::with(['linguisticReserve', 'linguisticReserveSchedule','linguisticUserHeadquers'])
            ->where('id', $scheduleId)->get();
        $linguisticId = $linguisticReserves[0]->id;
        Date::setLocale('es');
        $dateAppointment = $linguisticReserves[0]->date_reserve;
        $dateConvertedFormatted = Date::parse($dateAppointment)->format('l j F Y');

        $curp = $linguisticReserves[0]->linguisticReserve->linguisticUser->userParticipant->pluck('curp')->first();
        $keyEncrypt =  Crypt::encryptString($linguisticId . '*' . $dateAppointment . '*' . $curp);
        $fileName =  $linguisticReserves[0]->date_reserve . '-' . $curp . '-' . 'LINGUISTIC-' . $linguisticId . '.pdf';
            $pdf = PDF::loadView('livewire.linguistics.documents.linguistic-initial', compact('linguisticReserves', 'keyEncrypt', 'dateConvertedFormatted','linguisticId'));
            return $pdf->download($fileName);
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
