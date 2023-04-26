<?php

namespace App\Http\Livewire\Headquarters;

use App\Models\Catalogue\Headquarter;
use App\Models\Medicine\MedicineDisabledDays;
use App\Models\System;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class HomeHeadquarter extends Component
{
    use Actions;
    public $disabled_days;
    public function rules()
    {
        return [
            'disabled_days' => 'required',
        ];
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
    }
}
