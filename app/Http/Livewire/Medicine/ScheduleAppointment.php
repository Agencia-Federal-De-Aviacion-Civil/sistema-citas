<?php

namespace App\Http\Livewire\Medicine;

use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ScheduleAppointment extends Component
{
    public $exportJobProcessed = false;
    protected $listeners = ['checkExportJobProcessed' => 'checkExportJobProcessed'];
    public function mount()
    {
        $this->exportJobProcessed = Cache::get('exportJobProcessed', false);
    }
    public function render()
    {
        return view('livewire.medicine.schedule-appointment');
    }
    public function checkExportJobProcessed()
    {
        $this->exportJobProcessed = Cache::get('exportJobProcessed', false);
    }
}
