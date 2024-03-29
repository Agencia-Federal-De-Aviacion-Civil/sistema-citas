<?php

namespace App\Http\Livewire;

use App\Models\Catalogue\Headquarter;
use Livewire\Component;

class Dashboard extends Component
{
    public $selectedHeadquarter, $headquartersAfac, $stategrup,$headquartersAfac1;
    public function mount()
    {
       
        $this->headquartersAfac = Headquarter::where('status', 0)->get();
        $stategrup = $this->headquartersAfac ->groupBy('state');
        $this->stategrup =$stategrup->all();
    }
    public function rules()
    {
        return [
            'selectedHeadquarter' => 'required',
        ];
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
    public function selected()
    {
        $this->validate();
        $selectedValues = explode('-', $this->selectedHeadquarter);
        $id = $selectedValues[0];
        $idTypeAppointment = boolval($selectedValues[1]);
        session(['idType' => $idTypeAppointment, 'idHeadquarter' => $id]);
        redirect()->route('afac.medicine');
    }
    
    public function goAfac($idTypeAppointment)
    {
        // $currentIdType = session('idType');
        // dd($currentIdType);
        // if ($currentIdType !== $idTypeAppointment) {
        //     session()->forget('idType');
        // }
        // session(['idType' => $idTypeAppointment]);
    }
    public function messages()
    {
        return [
            'selectedHeadquarter.required' => 'Campo obligatorio'
        ];
    }
}
