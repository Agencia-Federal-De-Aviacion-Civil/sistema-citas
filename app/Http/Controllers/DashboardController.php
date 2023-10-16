<?php

namespace App\Http\Controllers;

use App\Models\Catalogue\Headquarter;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;

class DashboardController extends Controller
{
    public $headquarters, $dateNow;
    public function index()
    {
        Date::setLocale('es');
        $dateNow = Date::now()->format('l j F Y');
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
        } else {
            $appointment = MedicineReserve::query()
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->get();
            $headquarters = Headquarter::with([
                'headquarterMedicineReserve'
            ])
                ->where('is_external', false)
                ->get();


        }

        $appointmentNow = $appointment->where('dateReserve', $date1);
        $now = $appointmentNow->whereIn('status', ['0', '1', '4'])->sum('count');
        $registradas = $appointment->sum('count');
        $porconfir = $registradas != 0 ? round($appointment->where('status', '1')->sum('count') * 100 / $registradas, 0) : 0;
        $validado = $appointment->where('status', '1')->sum('count');
        $pendientes = $appointment->where('status', '0')->sum('count');
        $porpendientes = $registradas != 0 ? round($appointment->where('status', '0')->sum('count') * 100 / $registradas, 0) : 0;
        $canceladas = $appointment->whereIn('status', ['2', '3', '5'])->sum('count');
        $reagendado = round($appointment->whereIn('status', ['4','10'])->sum('count'));
        $porreagendado = $registradas != 0 ? round($appointment->whereIn('status', ['4','10'])->sum('count') * 100 / $registradas) : 0;
        $porcanceladas = $registradas != 0 ? round($appointment->whereIn('status', ['2', '3', '5'])->sum('count') * 100 / $registradas, 0) : 0;
        $apto = $appointment->where('status', '8')->sum('count');
        $porapto = $registradas != 0 ? round($appointment->where('status', '8')->sum('count') * 100 / $registradas, 0) : 0;
        $noapto = $appointment->where('status', '9')->sum('count');
        $pornoapto = $registradas != 0 ? round($appointment->where('status', '9')->sum('count') * 100 / $registradas, 0) : 0;
        $medicine =  round($registradas ? $registradas * 100 / $registradas : '0');
        $typeappoiment=2;
        return view('afac.dashboard.index', compact('headquarters', 'nameHeadquarter', 'registradas', 'pendientes', 'validado', 'canceladas', 'reagendado', 'porconfir', 'porpendientes', 'porreagendado', 'porcanceladas', 'now', 'date', 'date2', 'medicine', 'date1', 'tomorrow', 'dateNow','typeappoiment','apto','porapto','noapto','pornoapto'));
    }
}
