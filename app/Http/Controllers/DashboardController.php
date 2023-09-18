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
    public $headquarters, $dateNow, $typeappoiment;
    
    public function index()
    {
        Date::setLocale('es');
        $dateNow = Date::now()->format('l j F Y');
        $date = Date::now()->format('l j F Y');
        $date1 = Date::now()->format('Y-m-d');
        $date2 = Date::now()->format('d-m-Y');
        $tomorrow = Date::tomorrow()->format('Y-m-d');
        $nameHeadquarter = '';

        $appointment = MedicineReserve::query()
            ->select('status', DB::raw('count(*) as count'), 'dateReserve')
            ->groupBy('status', 'dateReserve')
            ->get();
        $headquarters = Headquarter::with([
            'headquarterMedicineReserve'
        ])
            ->where('is_external', false)
            ->get();
        //$appointmentNow = $appointment->where('dateReserve', $date1);
        //$now = $appointmentNow->whereIn('status', ['0', '1', '4'])->sum('count');
        //$porconfir = $registradas != 0 ? round($appointment->where('status', '1')->sum('count') * 100 / $registradas, 0) : 0;
        //$validado = $appointment->where('status', '1')->sum('count');
        //$pendientes = $appointment->where('status', '0')->sum('count');
        //$porpendientes = $registradas != 0 ? round($appointment->where('status', '0')->sum('count') * 100 / $registradas, 0) : 0;
        //$canceladas = $appointment->whereIn('status', ['2', '3', '5'])->sum('count');
        //$reagendado = round($appointment->where('status', '4')->sum('count'));
        //$porreagendado = $registradas != 0 ? round($appointment->where('status', '4')->sum('count') * 100 / $registradas) : 0;
        //$porcanceladas = $registradas != 0 ? round($appointment->whereIn('status', ['2', '3', '5'])->sum('count') * 100 / $registradas, 0) : 0;
        $registradas = $appointment->sum('count');
        $typeappoiment=2;
        $medicine =  round($registradas ? $registradas * 100 / $registradas : '0');
        return view('afac.dashboard.index', compact('headquarters', 'nameHeadquarter', 'registradas','dateNow','medicine','typeappoiment'));
    }
}
