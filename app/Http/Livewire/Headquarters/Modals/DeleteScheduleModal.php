<?php

namespace App\Http\Livewire\Headquarters\Modals;

use App\Models\Medicine\MedicineDisabledDays;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class DeleteScheduleModal extends ModalComponent
{
    use Actions;
    public $actionId;
    public function mount($actionId)
    {
        $this->actionId = $actionId;
    }
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
    public static function closeModalOnEscape(): bool
    {
        return false;
    }
    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
    public function render()
    {
        return view('livewire.headquarters.modals.delete-schedule-modal');
    }
    public function delete()
    {
        MedicineDisabledDays::find($this->actionId)->delete();
        $this->closeModal();
        $this->emit('deleteSchedule');
        $this->notification([
            'title'       => 'ELIMINADO ÉXITOSAMENTE',
            'icon'        => 'success',
            'timeout' => '3100'
        ]);
    }
}
