<?php

namespace App\Http\Livewire\Medicine\MedicineAfac;

use App\Models\Catalogue\Headquarter;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use Livewire\Component;

class HomeMedicineAfac extends Component
{

    public function render()
    {
        Date::setLocale('es');
        $dateNow_afac = Date::now()->format('l j F Y');
        $date_afac = Date::now()->format('l j F Y');
        $date1_afac = Date::now()->format('Y-m-d');
        $date2_afac = Date::now()->format('d-m-Y');
        $tomorrow_afac = Date::tomorrow()->format('Y-m-d');
        $nameHeadquarter_afac = '';
        if (Auth::user()->can('headquarters.see.dashboard')) {
            $appointment_afac = MedicineReserve::with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
                    $q1->where('user_id', Auth::user()->id);
                })
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->get();
            $headquarters_afac = Headquarter::with([
                'HeadquarterUserHeadquarter.userHeadquarterUserParticipant'
            ])->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q2) {
                $q2->where('user_id', Auth::user()->id);
            })->get();
            $nameHeadquarter_afac = $headquarters_afac->pluck('name_headquarter')->first();
        } else if (Auth::user()->can('sub_headquarters.see.dashboard')) {
            $appointment_afac = MedicineReserve::with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q3) {
                    $q3->where('user_id', Auth::user()->id);
                })
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->where('headquarter_id', 6)
                ->where('dateReserve', $date1_afac)
                ->get();
            $headquarters_afac = Headquarter::with([
                'HeadquarterUserHeadquarter.userHeadquarterUserParticipant'
            ])->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q2) {
                $q2->where('user_id', Auth::user()->id);
            })->get();
        } else {
            $appointment_afac = MedicineReserve::query()
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->where('is_external', false)
                ->get();
            $headquarters_afac = Headquarter::with([
                'headquarterMedicineReserve'
            ])
                ->where('is_external', false)
                ->get();
        }
        $appointmentNow_afac = $appointment_afac->where('dateReserve', $date1_afac);
        $now_afac = $appointmentNow_afac->whereIn('status', ['0', '1', '4'])->sum('count');
        $registradas_afac = $appointment_afac->sum('count');
        $porconfir_afac = $registradas_afac != 0 ? round($appointment_afac->where('status', '1')->sum('count') * 100 / $registradas_afac, 0) : 0;
        $validado_afac = $appointment_afac->where('status', '1')->sum('count');
        $pendientes_afac = $appointment_afac->where('status', '0')->sum('count');
        $porpendientes_afac = $registradas_afac != 0 ? round($appointment_afac->where('status', '0')->sum('count') * 100 / $registradas_afac, 0) : 0;
        $canceladas_afac = $appointment_afac->whereIn('status', ['2', '3', '5'])->sum('count');
        $reagendado_afac = round($appointment_afac->where('status', '4')->sum('count'));
        $porreagendado_afac = $registradas_afac != 0 ? round($appointment_afac->where('status', '4')->sum('count') * 100 / $registradas_afac) : 0;
        $porcanceladas_afac = $registradas_afac != 0 ? round($appointment_afac->whereIn('status', ['2', '3', '5'])->sum('count') * 100 / $registradas_afac, 0) : 0;
        $medicine_afac =  round($registradas_afac ? $registradas_afac * 100 / $registradas_afac : '0');
        // return view('livewire.medicine.medicine-afac.home-medicine-afac', compact('headquarters_afac', 'nameHeadquarter_afac', 'registradas_afac', 'pendientes_afac', 'validado_afac', 'canceladas_afac', 'reagendado_afac', 'porconfir_afac', 'porpendientes_afac', 'porreagendado_afac', 'porcanceladas_afac', 'now_afac', 'date_afac', 'date2_afac', 'medicine_afac', 'date1_afac', 'tomorrow_afac', 'dateNow_afac'));
        return view('livewire.medicine.medicine-afac.home-medicine-afac', compact('now_afac', 'registradas_afac', 'porconfir_afac', 'validado_afac', 'pendientes_afac', 'porpendientes_afac', 'canceladas_afac', 'reagendado_afac', 'porreagendado_afac', 'porcanceladas_afac', 'medicine_afac','date2_afac'));
    }
}
