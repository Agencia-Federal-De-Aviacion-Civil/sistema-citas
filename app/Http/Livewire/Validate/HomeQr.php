<?php

namespace App\Http\Livewire\Validate;

use App\Models\Medicine\MedicineReserve;
use Illuminate\Support\Facades\Crypt;
use Jenssegers\Date\Date;
use Livewire\Component;

class HomeQr extends Component
{
    public $medicineId;
    public function mount($medicineId)
    {
        $this->medicineId = $medicineId;
    }
    public function render()
    {
        $decrypted = Crypt::decryptString($this->medicineId);
        Date::setLocale('es');
        $medicineQuerys = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser'])->where('medicine_id', $decrypted)->get();
        $dateAppointment = $medicineQuerys[0]->dateReserve;
        $dateConvertedFormatted = Date::parse($dateAppointment)->format('l j F Y');
        return view('livewire.validate.home-qr', compact('medicineQuerys', 'dateConvertedFormatted'))
            ->layout('layouts.app');
    }
}
