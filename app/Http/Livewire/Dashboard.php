<?php

namespace App\Http\Livewire;

use App\Models\Catalogue\Headquarter;
use Livewire\Component;
use WireUi\Traits\Actions;

class Dashboard extends Component
{
    use Actions;
    public $selectedHeadquarter, $headquartersAfac, $stategrup, $headquartersAfac1, $headquartersAfacFilter, $estados;
    public function mount()
    {

        $this->headquartersAfac = Headquarter::where('status', 0)->get();
        $this->stategrup = $this->headquartersAfac->groupBy('state')->all();
        $this->estados = array_keys($this->stategrup);
        $this->headquartersAfac->whereIn('state', $this->estados); //AQUI VA EL VALOR DEL ESTADOS
    }
    public function rules()
    {
        return [
            // 'selectedHeadquarter' => 'required',
        ];
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
    public function selected()
    {
        // $this->validate();
        // $selectedValues = explode('-', $this->selectedHeadquarter);
        // $id = $selectedValues[0];
        // $idTypeAppointment = boolval($selectedValues[1]);
        // session(['idType' => $idTypeAppointment, 'idHeadquarter' => $id]);
        // redirect()->route('afac.medicine');
    }
    public function messages()
    {
        return [
            'selectedHeadquarter.required' => 'EL CAMPO SEDE ES OBLIGATORIO'
        ];
    }
}
