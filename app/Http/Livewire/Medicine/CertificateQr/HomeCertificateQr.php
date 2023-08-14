<?php

namespace App\Http\Livewire\Medicine\CertificateQr;

use App\Models\Catalogue\Nationality;
use App\Models\Medicine\MedicineReserve;
use App\Models\User;
use Jenssegers\Date\Date;
use Livewire\Component;
use WireUi\Traits\Actions;

class HomeCertificateQr extends Component
{
    use Actions;
    public $dateNow, $userQueries, $search = '', $userDetails = [], $nationalities;
    protected $listeners = [
        'searchUsers'
    ];
    public function rules()
    {
        return [
            'search' => 'required',
        ];
    }
    public function mount()
    {
        Date::setLocale('es');
        $this->dateNow = Date::now()->format('l j F Y');
        $this->nationalities = Nationality::all();
    }
    public function render()
    {
        return view('livewire.medicine.certificate-qr.home-certificate-qr')
            ->layout('layouts.app');
    }
    public function searchUsers()
    {
        $this->validate();
        try {
            $this->userQueries = MedicineReserve::with('medicineReserveFromUser.UserParticipant')
                ->whereHas('medicineReserveFromUser.UserParticipant', function ($q1) {
                    $q1->where('curp', $this->search);
                })
                ->where('status', 1)->get();
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
    }
}
