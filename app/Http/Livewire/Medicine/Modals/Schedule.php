<?php

namespace App\Http\Livewire\Medicine\Modals;

use App\Models\Medicine\MedicineReserve;
use Livewire\Component;
use LivewireUI\Modal\Modal;
use LivewireUI\Modal\ModalComponent;

class Schedule extends ModalComponent
{
    public $medicineReserves;
    public function mount($scheduleId)
    {
        $this->medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'user'])
        ->where('id',$scheduleId)
        ->get();

    }
    public function render()
    {
        return view('livewire.medicine.modals.schedule');
    }
}
