<?php

namespace App\Http\Controllers\afac;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine\MedicineReserve;
use App\Models\Catalogue\Headquarter;
use App\Models\Linguistic\LinguisticReserve;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;

class homeController extends Controller
{
    public $headquarters,$dateNow;
    public function index()
    {
        Date::setLocale('es');
        $dateNow = Date::now()->format('l j F Y');
        $date = Date::now()->format('l j F Y');
        $date1 = Date::now()->format('Y-m-d');
        $date2 = Date::now()->format('d-m-Y');
        $tomorrow = Date::tomorrow()->format('Y-m-d');

        if (Auth::user()->can('headquarters.see.dashboard')) {
            $appointment = MedicineReserve::query()
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                // ->where('dateReserve', $date1)
                ->groupBy('status', 'dateReserve')->where('to_user_headquarters', Auth::user()->id)
                ->get();

            $headquarters = Headquarter::with([
                'headquarterUser'
            ])->where('user_id', Auth::user()->id)->get();
        } else {
            $appointment = MedicineReserve::query()
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                // ->where('dateReserve', $date1)
                ->groupBy('status', 'dateReserve')
                ->get();
            $headquarters = Headquarter::with([
                'headquarterUser'
            ])->get();
            $appointmentlinguistc=LinguisticReserve::query()
            ->select('status', DB::raw('count(*) as count'), 'date_reserve')
            // ->where('dateReserve', $date1)
            ->groupBy('status', 'date_reserve')
            ->get();
        }

        $appointmentNow = $appointment->where('dateReserve', $date1);
        //$now = $appointmentNow->sum('count');
        $now = $appointmentNow->whereIn('status', ['0', '1', '4'])->sum('count');
        $registradas = $appointment->sum('count') + $appointmentlinguistc->sum('count') ;
        $datingmedicine=$appointment->sum('count');
        $datinglinguistic=$appointmentlinguistc->sum('count');
        $porconfir = $registradas != 0 ? round($appointment->where('status', '1')->sum('count') * 100 / $registradas, 0) : 0;
        $validado = $appointment->where('status', '1')->sum('count');
        $pendientes = $appointment->where('status', '0')->sum('count');
        $porpendientes = $registradas != 0 ? round($appointment->where('status', '0')->sum('count') * 100 / $registradas, 0) : 0;
        $canceladas = $appointment->whereIn('status', ['2', '3', '5'])->sum('count');
        $reagendado = round($appointment->where('status', '4')->sum('count'));
        $porreagendado = $registradas != 0 ? round($appointment->where('status', '4')->sum('count') * 100 / $registradas) : 0;
        $porcanceladas = $registradas != 0 ? round($appointment->whereIn('status', ['2', '3', '5'])->sum('count') * 100 / $registradas, 0) : 0;
        $medicine =  round($registradas ? $registradas * 100 / $registradas : '0');
        //Statistics for linguistics

        return view('afac.dashboard.index', compact('headquarters', 'datingmedicine','registradas', 'pendientes', 'validado', 'canceladas', 'reagendado', 'porconfir', 'porpendientes', 'porreagendado', 'porcanceladas', 'now', 'date', 'date2', 'medicine', 'date1', 'tomorrow','dateNow'));
    }
}
