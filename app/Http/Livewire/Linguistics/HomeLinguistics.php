<?php

namespace App\Http\Livewire\Linguistics;

use App\Models\Linguistic\Linguistic;
use App\Models\Linguistic\Reserve;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomeLinguistics extends Component
{
    public $referenceNumber, $headquarters, $dateReserve;
    public function rules()
    {
        return [
            'referenceNumber' => 'required',
            'headquarters' => 'required',
            'dateReserve' => 'required'
        ];
    }
    public function render()
    {
        return view('livewire.linguistics.home-linguistics')
            ->layout('layouts.app');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function save()
    {
        $this->validate();

        // Verificar si la hora ya está ocupada
        $existingReserve = Reserve::where('dateReserve', $this->dateReserve)->first();
        if ($existingReserve) {
            $this->addError('dateReserve', 'La hora seleccionada ya está ocupada. Por favor seleccione otra.');
            return;
        }

        $saveLinguistic = Linguistic::create([
            'user_id' => Auth::user()->id,
            'referenceNumber' => $this->referenceNumber,
        ]);

        $saveReserve = Reserve::create([
            'linguistic_id' => $saveLinguistic->id,
            'headquarters' => $this->headquarters,
            'dateReserve' => $this->dateReserve,
        ]);

        session()->flash('message', 'La reserva se ha guardado exitosamente.');
    }
}
