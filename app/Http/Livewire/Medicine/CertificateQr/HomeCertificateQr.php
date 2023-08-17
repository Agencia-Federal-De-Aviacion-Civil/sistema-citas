<?php

namespace App\Http\Livewire\Medicine\CertificateQr;

use App\Models\Catalogue\Nationality;
use App\Models\Document;
use App\Models\Medicine\CertificateQr\MedicineCertificateQr;
use App\Models\Medicine\MedicineReserve;
use App\Models\User;
use Jenssegers\Date\Date;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class HomeCertificateQr extends Component
{
    use Actions;
    use WithFileUploads;
    public $date_expire, $medical_name, $evaluation_result, $document_license_id, $dateNow, $userQueries, $search = '', $userDetails = [], $nationalities,
        $modalQr = false;
    protected $listeners = [
        'searchUsers'
    ];
    public function rules()
    {
        return [
            'date_expire' => 'required',
            'medical_name' => 'required',
            'evaluation_result' => 'required',
            'document_license_id' => 'required|mimetypes:application/pdf|max:5000',
        ];
    }
    public function mount()
    {
        Date::setLocale('es');
        $this->dateNow = Date::now()->format('l j F Y');
        $this->nationalities = Nationality::all();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.medicine.certificate-qr.home-certificate-qr');
    }
    public function closeModal()
    {
        $this->modalQr = false;
    }
    public function searchUsers()
    {
        $this->validate([
            'search' => 'required',
        ]);
        try {
            $this->userQueries = MedicineReserve::with('medicineReserveFromUser.UserParticipant')
                ->whereHas('medicineReserveFromUser.UserParticipant', function ($q1) {
                    $q1->where('curp', $this->search);
                })
                ->where('status', 1)->get();
            $idMedicineReserve = $this->userQueries->pluck('id')->first();
            session(['idReserve' => $idMedicineReserve]);
            if ($this->userQueries->isEmpty()) {
                throw new \Exception('NO SE ENCONTRARON RESULTADOS PARA EL CURP' . ' ' . $this->search);
            } else {
                $this->userDetails = $this->userQueries->first();
            }
        } catch (\Exception $e) {
            $this->dialog([
                'title'       => 'SIN RESULTADOS',
                'description' => $e->getMessage(),
                'icon'        => 'error',
            ]);
        }
    }
    public function save()
    {
        $this->validate();
        $reserveId = session('idReserve');
        try {
            $medicineQuery = MedicineCertificateQr::with(['certificateQrMedicineReserve.medicineReserveMedicine'])
                ->where('medicine_reserves_id', $reserveId)->get();
            if ($medicineQuery->count() > 0 && $medicineQuery[0]->certificateQrMedicineReserve->medicineReserveMedicine->type_exam_id == 1) {
                throw new \Exception('ESTA LICENCIA YA CUENTA CON CODIGO QR');
            } else if ($medicineQuery->count() > 0 && $medicineQuery[0]->certificateQrMedicineReserve->medicineReserveMedicine->type_exam_id == 2) {
                throw new \Exception('ESTA LICENCIA YA CUENTA CON CODIGO QR');
            } else if ($medicineQuery->count() > 0 && $medicineQuery[0]->certificateQrMedicineReserve->medicineReserveMedicine->type_exam_id == 3) {
                throw new \Exception('ESTA LICENCIA YA CUENTA CON CODIGO QR');
            }
            $extension = $this->document_license_id->getClientOriginalExtension();
            $fileName = $this->search . '-' . $this->date_expire . '-' . $this->evaluation_result . '.' . $extension;
            $saveDocument = Document::create([
                'name_document' => $this->document_license_id->storeAs('documentos/medicina/licenses', $fileName, 'public'),
            ]);
            $medicineQr = MedicineCertificateQr::create([
                'medicine_reserves_id' => $reserveId,
                'date_expire' => $this->date_expire,
                'medical_name' => $this->medical_name,
                'evaluation_result' => $this->evaluation_result,
                'document_license_id' => $saveDocument->id,
            ]);
            session(['idMedicineQr' => $medicineQr->id]);
            $this->userDetails = false;
            $this->modalQr = true;
            session()->forget('idReserve');
        } catch (\Exception $e) {
            $this->dialog([
                'title'       => 'ATENCIÓN',
                'description' => $e->getMessage(),
                'icon'        => 'info',
            ]);
        }
    }
    public function printQr()
    {
        $idQr = session('idMedicineQr');
        $idCertificate = MedicineCertificateQr::where('id', $idQr)->pluck('id')->first();
        session()->forget('idMedicineQr');
        $this->reset('search');
        redirect()->route('afac.certificateGenerate', $idCertificate);
    }
    public function messages()
    {
        return [
            'search.required' => 'Campo obligatorio',
            'date_expire.required' => 'Campo obligatorio',
            'medical_name.required' => 'Campo obligatorio',
            'evaluation_result.required' => 'Campo obligatorio',
            'document_license_id.required' => 'Campo obligatorio',
        ];
    }
}
