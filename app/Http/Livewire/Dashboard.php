<?php

namespace App\Http\Livewire;

use App\Models\Catalogue\Headquarter;
use App\Models\Medicine\MedicineReserve;
use App\Models\Security\SessionActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use WireUi\Traits\Actions;

class Dashboard extends Component
{
    use Actions;
    public $selectedHeadquarter, $headquartersAfac, $stategrup, $headquartersAfac1, $revaluation, $id_status;
    public function mount()
    {


        // $userMedicinesN = MedicineReserve::with(['medicineReserveMedicine','reserveMedicine'])
        // ->whereHas('medicineReserveMedicine', function ($q2) {
        // $q2->where('user_id', Auth::user()->id);
        // })->latest()->first();
        
        // $this->id_status =  $userMedicinesN ? ($userMedicinesN->first() ? $userMedicinesN->status : null) : null;

        $this->id_status = null;
        $this->headquartersAfac = Headquarter::where('status', 0)->get();
        $stategrup = $this->headquartersAfac->groupBy('state');
        $this->stategrup = $stategrup->all();
        $this->consultUserAutorize();
    }

    public function consultUserAutorize()
    {
        if (checkdnsrr('crp.sct.gob.mx', 'A')) {
            $key = request()->url();
            // SI EXISTE UN NO APTO RESETEA CACHE
             if($this->id_status == 9){
                Cache::forget($key);
            }
            $this->revaluation = Cache::remember($key,now()->addMonth(), function(){
            $endpoint = env('SIMA_API_REVALUATION', null);   
            $response = Http::withHeaders([
                'AuthorizationSima' => env('API_TOKEN_SIMA'),                                
                'Accept' => 'application/json'
            ])->connectTimeout(30)->get( 'https://siafac.afac.gob.mx/revaluation?user_id=' . Auth::user()->id);
            // https://siafac.afac.gob.mx/revaluation
            if ($response->successful()) {
                $statesSuccess = $response->json()['data'];
                if ($statesSuccess) {
                    $end = end($statesSuccess);
                    return $end['status'];
                } else {
                    return null;
                }
            }
           });
           
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
