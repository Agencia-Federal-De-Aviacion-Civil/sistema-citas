<?php

namespace App\Http\Livewire\Helpsheet;

use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\Medicine\MedicineReserve;
use Jenssegers\Date\Date;
use PDF;

class HomeHelpsheet extends Component
{
    use Actions;
    public function render()
    {
        return view('livewire.helpsheet.home-helpsheet')
        ->layout('layouts.app');;
    }

    public function download()
    {
        Date::setLocale('es');

        $fileName = "HOJA DE AYUDA";
        
            $pdf = PDF::loadView('livewire.helpsheet.documents.helpsheet-e5');
            return $pdf->download();
        
    }
    
}

