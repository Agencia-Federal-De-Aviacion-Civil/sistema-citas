<?php

namespace App\Http\Livewire\Medicine\CertificateQr;

use Jenssegers\Date\Date;
use Livewire\Component;

class HistoryCertificateQr extends Component
{
    public $dateNow;
    public function mount()
    {
        Date::setLocale('es');
        $this->dateNow = Date::now()->format('l j F Y');
    }
    public function render()
    {
        return view('livewire.medicine.certificate-qr.history-certificate-qr');
    }
}
