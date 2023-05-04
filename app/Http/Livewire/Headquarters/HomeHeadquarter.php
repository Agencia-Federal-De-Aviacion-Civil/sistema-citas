<?php

namespace App\Http\Livewire\Headquarters;

use App\Models\Medicine\MedicineDisabledDays;
use Jenssegers\Date\Date;
use Livewire\Component;
use WireUi\Traits\Actions;

class HomeHeadquarter extends Component
{
    use Actions;
    public $disabled_days,$dateNow;
    public function rules()
    {
        return [
            'disabled_days' => 'required',
        ];
    }
    public function mount(){
        Date::setLocale('es');
        $this->dateNow = Date::now()->format('l j F Y');
    }
    public function render()
    {
        return view('livewire.headquarters.home-headquarter')
            ->layout('layouts.app');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function save()
    {
        $this->validate();
        $disabledDaysArray = explode(', ', $this->disabled_days);
        foreach ($disabledDaysArray as $arrayDays) {
            MedicineDisabledDays::create([
                'disabled_days' => $arrayDays,
            ]);
        }
        $this->notification([
            'title'       => 'DIAS DESHABILITADOS EXITOSAMENTE',
            'icon'        => 'success',
            'timeout' => '3100'
        ]);
        $this->emit('disabledRecord');
        $this->reset(['disabled_days']);
    }
}
