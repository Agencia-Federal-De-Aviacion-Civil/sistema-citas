<?php

namespace App\Http\Livewire\Headquarters\Modals;

use App\Models\Medicine\MedicineDisabledDays;
use Illuminate\Support\Facades\Auth;
use App\Models\Medicine\medicine_history_movements;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class DeleteScheduleModal extends ModalComponent
{
    use Actions;
    public $actionId,$days,$nameHeadquarter;
    public function mount($actionId)
    {
        $this->actionId = $actionId;
        $this->days = MedicineDisabledDays::with('disabledDaysUser')->where('id', $actionId)->get();
        $this->nameHeadquarter = $this->days[0]->disabledDaysUser;
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
        
        //Historial de eliminar dias bloqueados
        medicine_history_movements::create([
            'user_id' => Auth::user()->id,
            'action' => "ELIMINA TODOS LOS DIAS BLOQUEADOS",
            'process' => 'SEDE: '. $this->nameHeadquarter->name
        ]);
    }
}
