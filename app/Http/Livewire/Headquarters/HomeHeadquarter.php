<?php

namespace App\Http\Livewire\Headquarters;

use App\Models\Catalogue\Headquarter;
use App\Models\Medicine\MedicineDisabledDays;
use Livewire\Component;
use WireUi\Traits\Actions;

class HomeHeadquarter extends Component
{
    use Actions;
    public $disabled_days, $user_headquarters_id;
    public function rules()
    {
        return [
            'disabled_days' => 'required',
            'user_headquarters_id' => 'required|unique:medicine_disabled_days',
        ];
    }
    public function render()
    {
        $headquarters = Headquarter::with('headquarterUser')->get();
        return view('livewire.headquarters.home-headquarter', compact('headquarters'))
            ->layout('layouts.app');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function save()
    {
        $this->validate();
        // $disabledDaysArray = explode(', ', $this->disabled_days);
        // foreach ($disabledDaysArray as $arrayDays) {
        MedicineDisabledDays::create([
            'user_headquarters_id' => $this->user_headquarters_id,
            'disabled_days' => $this->disabled_days,
        ]);
        // }
        $this->notification([
            'title'       => 'DIAS DESHABILITADOS EXITOSAMENTE',
            'icon'        => 'success',
            'timeout' => '3100'
        ]);
        $this->emit('disabledRecord');
        $this->reset(['disabled_days']);
    }
    public function messages()
    {
        return [
            'user_headquarters_id.required' => 'Campo obligatorio',
            'disabled_days.required' => 'Campo obligatorio'
        ];
    }
}
