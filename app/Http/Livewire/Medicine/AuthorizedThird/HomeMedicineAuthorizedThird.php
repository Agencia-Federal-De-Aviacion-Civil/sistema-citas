<?php

namespace App\Http\Livewire\Medicine\AuthorizedThird;

use App\Models\Catalogue\Headquarter;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use Livewire\Component;

class HomeMedicineAuthorizedThird extends Component
{

    public function render()
    {
        $date1_third = Date::now()->format('l j F Y');
        $date1_third = Date::now()->format('Y-m-d');
        $date2_third = Date::now()->format('d-m-Y');
        $tomorrow_third = Date::tomorrow()->format('Y-m-d');
        $nameHeadquarter_third = '';
        if (Auth::user()->can('headquarters.see.dashboard')) {
            $appointment = MedicineReserve::with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
                    $q1->where('user_id', Auth::user()->id);
                })
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->get();
            $headquarters_third = Headquarter::with([
                'HeadquarterUserHeadquarter.userHeadquarterUserParticipant'
            ])->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q2) {
                $q2->where('user_id', Auth::user()->id);
            })->get();
            $nameHeadquarter_third = $headquarters_third->pluck('name_headquarter')->first();
        } else if (Auth::user()->can('sub_headquarters.see.dashboard')) {
            $appointment_third = MedicineReserve::with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q3) {
                    $q3->where('user_id', Auth::user()->id);
                })
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->where('headquarter_id', 6)
                ->where('dateReserve', $date1)
                ->get();
            $headquarters_third = Headquarter::with([
                'HeadquarterUserHeadquarter.userHeadquarterUserParticipant'
            ])->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q2) {
                $q2->where('user_id', Auth::user()->id);
            })->get();
        } else if (Auth::user()->can('headquarters_authorized.see.dashboard')) {
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
            $nameHeadquarter_third = '"'. $headquarters->pluck('name_headquarter')->first().'"';
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
        $now_third = $appointmentNow_third->whereIn('status', ['0', '1', '4'])->sum('count');
        $registradas_third = $appointment_third->sum('count');
        $porconfir_third = $registradas_third != 0 ? round($appointment_third->where('status', '1')->sum('count') * 100 / $registradas_third, 0) : 0;
        $validado_third = $appointment_third->where('status', '1')->sum('count');
        $pendientes_third = $appointment_third->where('status', '0')->sum('count');
        $porpendientes_third = $registradas_third != 0 ? round($appointment_third->where('status', '0')->sum('count') * 100 / $registradas_third, 0) : 0;
        $canceladas_third = $appointment_third->whereIn('status', ['2', '3', '5'])->sum('count');
        $reagendado_third = round($appointment->where('status', '4')->sum('count'));
        $porreagendado_third = $registradas_third != 0 ? round($appointment_third->where('status', '4')->sum('count') * 100 / $registradas_third) : 0;
        $porcanceladas_third = $registradas_third != 0 ? round($appointment_third->whereIn('status', ['2', '3', '5'])->sum('count') * 100 / $registradas_third, 0) : 0;
        $medicine_third =  round($registradas_third ? $registradas_third * 100 / $registradas_third : '0');
        return view('livewire.medicine.authorized-third.home-medicine-authorized-third', compact('headquarters', 'nameHeadquarter', 'registradas', 'pendientes', 'validado', 'canceladas', 'reagendado', 'porconfir', 'porpendientes', 'porreagendado', 'porcanceladas', 'now', 'date', 'date2', 'medicine', 'date1', 'tomorrow'));
    }
}
