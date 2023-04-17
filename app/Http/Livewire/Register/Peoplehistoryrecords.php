<?php

namespace App\Http\Livewire\Register;

use App\Models\appointment\user_appointment_success;
use App\Models\appointment\userAppointment;
use App\Models\Medicine\MedicineReserve;
use Livewire\Component;
use PDF;

class Peoplehistoryrecords extends Component
{
    public $medicineReserves;
    public function render()
    {
        //$this->medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'user'])->get();
        return view('livewire.register.people-history-records');
    }
    
}
