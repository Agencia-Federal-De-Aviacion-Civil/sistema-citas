<?php

namespace App\Http\Livewire\Medicine\AuthorizedThird;

use App\Models\Catalogue\Headquarter;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use Livewire\Component;

class HomeSuperMedicineAuthorizedThird extends Component
{

    public function render()
    {
        $date_third = Date::now()->format('l j F Y');
        $date1_third = Date::now()->format('Y-m-d');
        $date2_third = Date::now()->format('d-m-Y');
        $tomorrow_third = Date::tomorrow()->format('Y-m-d');
        $nameHeadquarter_third = '';
        // if (Auth::user()->can('headquarters.see.dashboard')) {
        //     $appointment_third = MedicineReserve::with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
        //         ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
        //             $q1->where('user_id', Auth::user()->id);
        //         })
        //         ->select('status', DB::raw('count(*) as count'), 'dateReserve')
        //         ->groupBy('status', 'dateReserve')
        //         ->get();
        //     $headquarters_third = Headquarter::with([
        //         'HeadquarterUserHeadquarter.userHeadquarterUserParticipant'
        //     ])->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q2) {
        //         $q2->where('user_id', Auth::user()->id);
        //     })->get();
        //     $nameHeadquarter_third = $headquarters_third->pluck('name_headquarter')->first();
        // } else if (Auth::user()->can('sub_headquarters.see.dashboard')) {
        //     $appointment_third = MedicineReserve::with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
        //         ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q3) {
        //             $q3->where('user_id', Auth::user()->id);
        //         })
        //         ->select('status', DB::raw('count(*) as count'), 'dateReserve')
        //         ->groupBy('status', 'dateReserve')
        //         ->where('headquarter_id', 6)
        //         ->where('dateReserve', $date1_third)
        //         ->get();
        //     $headquarters_third = Headquarter::with([
        //         'HeadquarterUserHeadquarter.userHeadquarterUserParticipant'
        //     ])->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q2) {
        //         $q2->where('user_id', Auth::user()->id);
        //     })->get();
        // } else 
        if (Auth::user()->can('headquarters_authorized.see.dashboard')) {
            $appointment_third = MedicineReserve::with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
                    $q1->where('user_id', Auth::user()->id);
                })
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->get();
            $headquarters_third = Headquarter::with([
                'HeadquarterUserHeadquarter.userHeadquarterUserParticipant','headquarterMedicineReserve'
            ])->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q2) {
                $q2->where('user_id', Auth::user()->id);
            })->where('is_external', true)->get();
            $nameHeadquarter_third = '"'. $headquarters_third->pluck('name_headquarter')->first().'"';
        } else {
            $appointment_third = MedicineReserve::query()
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->where('is_external', true)
                ->get();
            $headquarters_third = Headquarter::with([
                'headquarterMedicineReserve'
            ])
                ->where('is_external', true)
                ->get();
            $nameHeadquarter_third = 'TERCEROS';
        }

        $appointmentNow_third = $appointment_third->where('dateReserve', $date1_third);
        $now_third = $appointmentNow_third->whereIn('status', ['0', '1', '4', '10','7','8','9'])->sum('count');
        $registradas_third = $appointment_third->sum('count');
        $porconfir_third = $registradas_third != 0 ? round($appointment_third->where('status', '1')->sum('count') * 100 / $registradas_third, 0) : 0;
        $validado_third = $appointment_third->where('status', '1')->sum('count');
        $pendientes_third = $appointment_third->whereIn('status', ['0'])->sum('count');
        $porpendientes_third = $registradas_third != 0 ? round($appointment_third->where('status', '0')->sum('count') * 100 / $registradas_third, 0) : 0;
        $canceladas_third = $appointment_third->whereIn('status', ['2', '3', '5'])->sum('count');
        $reagendado_third = round($appointment_third->whereIn('status', ['4','10'])->sum('count'));
        $porreagendado_third = $registradas_third != 0 ? round($appointment_third->whereIn('status', ['4','10'])->sum('count') * 100 / $registradas_third) : 0;
        $porcanceladas_third = $registradas_third != 0 ? round($appointment_third->whereIn('status', ['2', '3', '5'])->sum('count') * 100 / $registradas_third, 0) : 0;
        $apto_third = $appointment_third->where('status', '8')->sum('count');
        $porapto_third = $registradas_third != 0 ? round($appointment_third->where('status', '8')->sum('count') * 100 / $registradas_third, 0) : 0;
        $noapto_third = $appointment_third->where('status', '9')->sum('count');
        $pornoapto_third = $registradas_third != 0 ? round($appointment_third->where('status', '9')->sum('count') * 100 / $registradas_third, 0) : 0;
        $aplazadas_third = $appointment_third->where('status', '7')->sum('count');
        $poraplazada_third = $registradas_third != 0 ? round($appointment_third->where('status', '7')->sum('count') * 100 / $registradas_third, 0) : 0;

        $medicine_third =  round($registradas_third ? $registradas_third * 100 / $registradas_third : '0');
        return view('livewire.medicine.authorized-third.home-super-medicine-authorized-third', compact('headquarters_third', 'nameHeadquarter_third', 'registradas_third', 'pendientes_third', 'validado_third', 'canceladas_third', 'reagendado_third', 'porconfir_third', 'porpendientes_third', 'porreagendado_third', 'porcanceladas_third', 'now_third', 'date_third', 'date2_third', 'medicine_third', 'date1_third', 'tomorrow_third','apto_third','porapto_third','noapto_third','pornoapto_third','aplazadas_third','poraplazada_third'));
    }
}
