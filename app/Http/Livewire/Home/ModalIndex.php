<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

class ModalIndex extends Component
{
    public $modal = true;
    public $modalSelect = false;
    public function render()
    {
        return view('livewire.home.modal-index');
    }
    public function showModalSelect()
    {
        $this->modalSelect = true;
    }
    
}
