<?php

namespace App\Http\Livewire\Medicine\Modals;

use App\Models\Medicine\Medicine;
use App\Models\Medicine\MedicineReserve;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class CancelAppointmentUserModal extends ModalComponent
{
    public $scheduleId, $medicineId;
    public function mount($scheduleId, $medicineId)
    {
        $this->scheduleId = $scheduleId;
        $this->medicineId = $medicineId;
    }
    public function render()
    {
        return view('livewire.medicine.modals.cancel-appointment-user-modal');
    }
    public function save()
    {
        $cancelReserveUser = MedicineReserve::find($this->scheduleId);
        $cancelReserveUser->update([
            'status' => 3,
        ]);
        $cancelMedicineUser = Medicine::find($this->medicineId);
        $cancelMedicineUser->update([
            'reference_number' => 'ACTIVE' . '-' . $this->medicineId,
        ]);
        $this->emit('cancelReserve');
        $this->closeModal();
    }
}
