<?php

namespace App\Http\Livewire\Medicine\TableActions;

use App\Models\Medicine\MedicineReserve;
use Deployer\Collection\Collection;
use Livewire\Component;

class DownloadFile extends Component
{
    public function render()
    {
        return view('livewire.medicine.table-actions.download-file');
    }
}
