<?php

namespace App\Http\Livewire\Catalogue;

use Jenssegers\Date\Date;
use Livewire\Component;

class HomeCatalogs extends Component
{
    public $dateNow;
    public function mount()
    {
        Date::setLocale('es');
        $this->dateNow = Date::now()->format('l j F Y');
    }
    public function render()
    {
        return view('livewire.catalogue.home-catalogs');
    }
    
}
