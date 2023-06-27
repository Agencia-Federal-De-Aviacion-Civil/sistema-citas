<?php

namespace App\Http\Livewire\Validate;

use App\Models\Linguistic\LinguisticReserve;
use Illuminate\Support\Facades\Crypt;
use Jenssegers\Date\Date;
use Livewire\Component;

class HomeQr extends Component
{
    public $linguisticId;
    public function mount($linguisticId)
    {
        $this->linguisticId = $linguisticId;
    }
    public function render()
    {
        $decrypted = Crypt::decryptString($this->linguisticId);
        Date::setLocale('es');
        $lingisticQuerys = LinguisticReserve::with(['linguisticReserve', 'linguisticReserveFromUser'])->where('linguistic_id', $decrypted)->get();
        $dateAppointment = $lingisticQuerys[0]->dateReserve;
        $dateConvertedFormatted = Date::parse($dateAppointment)->format('l j F Y');
        return view('livewire.validate.home-qr', compact('lingisticQuerys', 'dateConvertedFormatted'))
            ->layout('layouts.app');
    }
}
