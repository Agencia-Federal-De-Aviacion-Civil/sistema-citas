<?php

namespace App\Http\Livewire\Headquarters\Modals;

use App\Models\Medicine\MedicineDisabledDays;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class DeleteScheduleModal extends ModalComponent
{
    use Actions;
    public $deleteId;
    public function mount($deleteId)
    {
        $this->deleteId = $deleteId;
    }
    public function render()
    {
        return view('livewire.headquarters.modals.delete-schedule-modal');
    }
    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return 'md';
    }
    public function delete()
    {
        MedicineDisabledDays::find($this->deleteId)->delete();
        $this->notification([
            'title'       => 'DIA HABILITADO CORRECTAMENTE',
            'icon'        => 'success',
            'timeout' => '3100'
        ]);
        $this->closeModal();
        $this->emit('deleteDay');
    }
}
