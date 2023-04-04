<?php

namespace App\Http\Livewire\Medicine\Modals;

use Livewire\Component;

class ModalIndex extends Component
{
    public $modal = true;
    public $modalSelect = false;
    public function render()
    {
        return view('livewire.medicine.modals.modal-index');
    }
    public function showModalSelect()
    {
        $this->modalSelect = true;
    }
    
}
