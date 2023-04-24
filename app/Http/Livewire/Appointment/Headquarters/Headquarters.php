<?php

namespace App\Http\Livewire\Appointment\Headquarters;

use App\Models\Catalogue\Headquarter;
use App\Models\Medicine\MedicineDisabled;
use App\Models\System;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Headquarters extends Component
{
    use Actions;
    public $range_appointment;
    public function mount()
    {
    }
    public function rules()
    {
        return [
            'range_appointment' => 'required',

        ];
    }
    public function render()
    {
        return view('livewire.appointment.headquarters.headquarters')
            ->layout('layouts.app');
    }
    public function save()
    {
        $this->validate();
        $disabled = MedicineDisabled::create([
            'range_appointment' => implode(",", $this->range_appointment),
        ]);
        $this->notification([
            'title'       => 'SEDE AGREGADA ÉXITOSAMENTE',
            'icon'        => 'success',
            'timeout' => '3100'
        ]);
    }
}
