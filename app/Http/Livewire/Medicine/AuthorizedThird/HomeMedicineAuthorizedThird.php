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
        $date = Date::now()->format('l j F Y');
        $date1 = Date::now()->format('Y-m-d');
        $date2 = Date::now()->format('d-m-Y');
        $tomorrow = Date::tomorrow()->format('Y-m-d');
        $nameHeadquarter = '';
        if (Auth::user()->can('headquarters.see.dashboard')) {
            $appointment = MedicineReserve::with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
                    $q1->where('user_id', Auth::user()->id);
                })
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->get();
            $headquarters = Headquarter::with([
                'HeadquarterUserHeadquarter.userHeadquarterUserParticipant'
            ])->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q2) {
                $q2->where('user_id', Auth::user()->id);
            })->get();
            $nameHeadquarter = $headquarters->pluck('name_headquarter')->first();
        } else if (Auth::user()->can('sub_headquarters.see.dashboard')) {
            $appointment = MedicineReserve::with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q3) {
                    $q3->where('user_id', Auth::user()->id);
                })
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->where('headquarter_id', 6)
                ->where('dateReserve', $date1)
                ->get();
            $headquarters = Headquarter::with([
                'HeadquarterUserHeadquarter.userHeadquarterUserParticipant'
            ])->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q2) {
                $q2->where('user_id', Auth::user()->id);
            })->get();
        } else if (Auth::user()->can('headquarters_authorized.see.dashboard')) {
            $appointment = MedicineReserve::with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
                    $q1->where('user_id', Auth::user()->id);
                })
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->get();
            $headquarters = Headquarter::with([
                'HeadquarterUserHeadquarter.userHeadquarterUserParticipant','headquarterMedicineReserve'
            ])->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q2) {
                $q2->where('user_id', Auth::user()->id);
            })->where('is_external', true)->get();
            $nameHeadquarter = '"'. $headquarters->pluck('name_headquarter')->first().'"';
        } else {
            $appointment = MedicineReserve::query()
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->where('is_external', true)
                ->get();
            $headquarters = Headquarter::with([
                'headquarterMedicineReserve'
            ])
                ->where('is_external', true)
                ->get();
            $nameHeadquarter = 'TERCEROS';
        }

        $appointmentNow = $appointment->where('dateReserve', $date1);
        $now = $appointmentNow->whereIn('status', ['0', '1', '4'])->sum('count');
        $registradas = $appointment->sum('count');
        $porconfir = $registradas != 0 ? round($appointment->where('status', '1')->sum('count') * 100 / $registradas, 0) : 0;
        $validado = $appointment->where('status', '1')->sum('count');
        $pendientes = $appointment->where('status', '0')->sum('count');
        $porpendientes = $registradas != 0 ? round($appointment->where('status', '0')->sum('count') * 100 / $registradas, 0) : 0;
        $canceladas = $appointment->whereIn('status', ['2', '3', '5'])->sum('count');
        $reagendado = round($appointment->where('status', '4')->sum('count'));
        $porreagendado = $registradas != 0 ? round($appointment->where('status', '4')->sum('count') * 100 / $registradas) : 0;
        $porcanceladas = $registradas != 0 ? round($appointment->whereIn('status', ['2', '3', '5'])->sum('count') * 100 / $registradas, 0) : 0;
        $medicine =  round($registradas ? $registradas * 100 / $registradas : '0');
        return view('livewire.medicine.authorized-third.home-medicine-authorized-third', compact('headquarters', 'nameHeadquarter', 'registradas', 'pendientes', 'validado', 'canceladas', 'reagendado', 'porconfir', 'porpendientes', 'porreagendado', 'porcanceladas', 'now', 'date', 'date2', 'medicine', 'date1', 'tomorrow'));
    }
}
