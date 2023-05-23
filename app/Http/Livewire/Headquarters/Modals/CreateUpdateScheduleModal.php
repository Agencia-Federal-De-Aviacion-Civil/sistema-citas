<?php

namespace App\Http\Livewire\Headquarters\Modals;

use App\Models\Catalogue\Headquarter;
use App\Models\Medicine\MedicineDisabledDays;
use Illuminate\Support\Facades\Auth;
use App\Models\Medicine\medicine_history_movements;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;


class CreateUpdateScheduleModal extends ModalComponent
{
    use Actions;
    public $actionId, $days, $disabled_days, $id_disabledDays, $user_headquarters_id, $nameHeadquarter;
    public function rules()
    {
        $rules = [
            'disabled_days' => 'required',
        ];
        $rules['user_headquarters_id'] = $this->id_disabledDays ? '' : 'required|unique:medicine_disabled_days';
        return $rules;
    }
    public function mount($actionId = null)
    {
        if (isset($actionId)) {
            $this->actionId = $actionId;
            $this->days = MedicineDisabledDays::with('disabledDaysUser')->where('id', $actionId)->get();
            $this->nameHeadquarter = $this->days[0]->disabledDaysUser;
            $this->disabled_days = $this->days[0]->disabled_days;
            $this->id_disabledDays = $this->days[0]->id;
        } else {
            $this->actionId = null;
        }
    }
    public function render()
    {
        $headquarters = Headquarter::with('headquarterUser')->get();
        return view('livewire.headquarters.modals.create-update-schedule-modal', compact('headquarters'));
    }
    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
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
    public function actionSave()
    {
        $this->validate();
        $accions="ACTUALIZA BLOQUEO DE DIAS";
        $userData = [
            'disabled_days' => $this->disabled_days,
        ];
        if (!$this->id_disabledDays) {
            $userData['user_headquarters_id'] = $this->user_headquarters_id;
            $accions="GENERA BLOQUEO DE DIAS";
        }
        // if ($this->user_headquarters_id == 0) {
        //     $all_headquarters = Headquarter::with('headquarterUser')->get();
        //     foreach ($all_headquarters as $headquarter) {
        //         $userData['user_headquarters_id'] = $headquarter->headquarterUser->id;
        //         MedicineDisabledDays::updateOrCreate(
        //             ['id' => $this->id_disabledDays],
        //             $userData $this->nameHeadquarter->name
        //         );
        //     }
        // } 
        // else {
        MedicineDisabledDays::updateOrCreate(
            ['id' => $this->id_disabledDays],
            $userData
        );
        //Historial de guardar y editar dias deshabilitados
        medicine_history_movements::create([
            'user_id' => Auth::user()->id,
            'action' => $accions,
            'process' => $this->disabled_days.' '.'SEDE: '.$this->id_disabledDays
        ]);
        // }
        $this->notification([
            'title'       => 'CAMBIOS RELIZADOS EXITOSAMENTE',
            'icon'        => 'success',
            'timeout' => '3100'
        ]);
        $this->closeModal();
        $this->emit('createOrUpdateSchedule');
    }
    public function messages()
    {
        return [
            'disabled_days.required' => 'Campo obligatorio',
            'user_headquarters_id.required' => 'Campo obligatorio',
            'user_headquarters_id.unique' => 'La sede seleccionada ya cuenta con días deshabilitados, por favor selecciona otra o bien, si deseas añadir más días a esta sede, selecciona editar en el botón de la tabla.',
        ];
    }
}
