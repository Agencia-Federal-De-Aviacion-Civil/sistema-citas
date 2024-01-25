<?php

namespace App\Http\Livewire\Medicine\Modals;

use App\Models\Medicine\Medicine;
use App\Models\Medicine\MedicineReserve;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class ReleaseShareModal extends ModalComponent
{
    use Actions;
    public $scheduleId, $medicineId;
    public function mount($scheduleId, $medicineId)
    {
        $this->scheduleId = $scheduleId;
        $this->medicineId = $medicineId;
    }
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
    public function render()
    {
        return view('livewire.medicine.modals.release-share-modal');
    }
    public function store()
    {
        $updateMedicine = MedicineReserve::find($this->scheduleId);
        $updateMedicine->update([
            'status' => 0
        ]);
        $this->notification([
            'title'       => 'ACCIONES LIBERADAS!',
            // 'description' => '',
            'icon'        => 'success'
        ]);
        $this->emit('updateReleaseShare');
        $this->closeModal();
    }
}
