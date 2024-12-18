<?php

namespace App\Http\Livewire;

use App\Models\Catalogue\Headquarter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use WireUi\Traits\Actions;

class Dashboard extends Component
{
    use Actions;
    public $selectedHeadquarter, $headquartersAfac, $stategrup, $headquartersAfac1, $revaluation;
    public function mount()
    {
        $this->headquartersAfac = Headquarter::where('status', 0)->get();
        $stategrup = $this->headquartersAfac->groupBy('state');
        $this->stategrup = $stategrup->all();
        $this->consultUserAutorize();
    }

    public function consultUserAutorize()
    {
        if (checkdnsrr('crp.sct.gob.mx', 'A')) {
            $response = Http::withHeaders([
                'Accept' => 'application/json'
            ])->connectTimeout(30)->get('https://siafac.afac.gob.mx/revaluation?user_id=' . Auth::user()->id);
            if ($response->successful()) {
                $statesSuccess = $response->json()['data'];
                if ($statesSuccess) {
                    $end = end($statesSuccess);
                    $this->revaluation =  $end['status'];
                } else {
                    $this->revaluation = null;
                }
            }

        } else {

            $this->notification()->send([
                'icon' => 'info',
                'title' => 'Sin conexión!',
                'description' => 'No hay conexión, vuelve a intentarlo.',
                'timeout' => '3100'
            ]);
        }
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
