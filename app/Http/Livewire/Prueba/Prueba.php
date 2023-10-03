<?php

namespace App\Http\Livewire\Prueba;

use App\Models\Catalogue\Headquarter;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Prueba extends Component
{
    public $headquarters_afac1,$date1_afac1,$tomorrow_afac1;
    public function render()
    {
        Date::setLocale('es');
        // $dateNow_afac1 = Date::now()->format('l j F Y');
        // $date_afac1 = Date::now()->format('l j F Y');
        $date1_afac1 = Date::now()->format('Y-m-d');
        $date2_afac1 = Date::now()->format('d-m-Y');
        // $tomorrow_afac1 = Date::tomorrow()->format('Y-m-d');

        $nameHeadquarter_afac1 = '';
        if (Auth::user()->can('headquarters.see.dashboard')) {
            $appointment_afac1 = MedicineReserve::with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
                    $q1->where('user_id', Auth::user()->id);
                })
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->get();
            // $headquarters_afac1 = Headquarter::with([
            //     'HeadquarterUserHeadquarter.userHeadquarterUserParticipant'
            // ])->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q2) {
            //     $q2->where('user_id', Auth::user()->id);
            // })->get();
            // $nameHeadquarter_afac1 = $headquarters_afac1->pluck('name_headquarter')->first();
        } else if (Auth::user()->can('sub_headquarters.see.dashboard')) {
            $appointment_afac1 = MedicineReserve::with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q3) {
                    $q3->where('user_id', Auth::user()->id);
                })
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->where('headquarter_id', 6)
                ->where('dateReserve', $date1_afac1)
                ->get();
            // $headquarters_afac1 = Headquarter::with([
            //     'HeadquarterUserHeadquarter.userHeadquarterUserParticipant'
            // ])->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q2) {
            //     $q2->where('user_id', Auth::user()->id);
            // })->get();
        } else {

            $appointment_afac1 = MedicineReserve::query()
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->where('is_external', false)
                ->get();
            $headquarters_afac = Headquarter::with([
                'headquarterMedicineReserve'
            ])->where('is_external', false)->get();
        }


        $appointmentNow_afac1 = $appointment_afac1->where('dateReserve', $date1_afac1);
        $now_afac1 = $appointmentNow_afac1->whereIn('status', ['0', '1', '4'])->sum('count');
        $registradas_afac1 = $appointment_afac1->sum('count');
        $porconfir_afac1 = $registradas_afac1 != 0 ? round($appointment_afac1->where('status', '1')->sum('count') * 100 / $registradas_afac1, 0) : 0;
        $validado_afac1 = $appointment_afac1->where('status', '1')->sum('count');
        $pendientes_afac1 = $appointment_afac1->where('status', '0')->sum('count');
        $porpendientes_afac1 = $registradas_afac1 != 0 ? round($appointment_afac1->where('status', '0')->sum('count') * 100 / $registradas_afac1, 0) : 0;
        $canceladas_afac1 = $appointment_afac1->whereIn('status', ['2', '3', '5'])->sum('count');
        $reagendado_afac1 = round($appointment_afac1->where('status', '4')->sum('count'));
        $porreagendado_afac1 = $registradas_afac1 != 0 ? round($appointment_afac1->where('status', '4')->sum('count') * 100 / $registradas_afac1) : 0;
        $porcanceladas_afac1 = $registradas_afac1 != 0 ? round($appointment_afac1->whereIn('status', ['2', '3', '5'])->sum('count') * 100 / $registradas_afac1, 0) : 0;

        return view('livewire.prueba.prueba' ,compact('date2_afac1','now_afac1','registradas_afac1','porconfir_afac1','validado_afac1','pendientes_afac1','porpendientes_afac1','canceladas_afac1','reagendado_afac1','porcanceladas_afac1','porreagendado_afac1','headquarters_afac'));
    }
}
