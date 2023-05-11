<?php

namespace App\Http\Controllers\afac;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine\MedicineReserve;
use App\Models\Catalogue\Headquarter;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;

class homeController extends Controller
{
    public $headquarters;
    public function index()
    {
        Date::setLocale('ES');
        $date = Date::now()->parse();
        $date1 = Date::now()->format('Y-m-d');
        $date2 = Date::now()->format('d-m-Y');
        $tomorrow = Date::tomorrow()->format('Y-m-d');
        $appointment = MedicineReserve::query()
            ->select('status', DB::raw('count(*) as count'), 'dateReserve')
            // ->where('dateReserve', $date1)
            ->groupBy('status','dateReserve')
            ->get();
        $appointmentNow = $appointment->where('dateReserve', $date1);
        //$now = $appointmentNow->sum('count');
        $now = $appointmentNow->whereIn('status',['0','1','4'])->sum('count');
        $registradas = $appointment->sum('count');
        $porconfir = round($appointment->where('status', '1')->sum('count') * 100 / $registradas, 0);
        $validado = $appointment->where('status', '1')->sum('count');
        $pendientes = $appointment->where('status', '0')->sum('count');
        $porpendientes = round($appointment->where('status', '0')->sum('count') * 100 / $registradas, 0);
        $canceladas = $appointment->whereIn('status', ['2', '3'])->sum('count');
        $reagendado = round($appointment->where('status', '4')->sum('count'));
        $porreagendado = round($appointment->where('status', '4')->sum('count') * 100 / $registradas);
        $porcanceladas = round($appointment->whereIn('status', ['2', '3'])->sum('count') * 100 / $registradas,0);
        $medicine =  round($registradas ? $registradas * 100 / $registradas : '0');

        $headquarters = Headquarter::with([
            'headquarterUser'
        ])->get();
        return view('afac.dashboard.index', compact('headquarters', 'registradas', 'pendientes', 'validado', 'canceladas', 'reagendado', 'porconfir', 'porpendientes', 'porreagendado', 'porcanceladas', 'now', 'date','date2','medicine','date1','tomorrow'));
    }
}
