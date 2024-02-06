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
    public $headquarters;
    public function index()
    {
        Date::setLocale('es');
        $date1 = Date::now()->format('Y-m-d');
        $date2 = Date::now()->format('d-m-Y');
        $nameHeadquarter = '';
        $appointmentReserves = '';
        $headquarters = Headquarter::with([
            'HeadquarterUserHeadquarter.userHeadquarterUserParticipant'
        ])
            ->when(Auth::user()->canany(['headquarters.see.dashboard', 'sub_headquarters.see.dashboard']), function ($headquarters) {
                $headquarters->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
                    $q1->where('user_id', Auth::user()->id);
                });
            })
            ->get();
        $nameHeadquarter = (Auth::user()->canany(['headquarters.see.dashboard', 'sub_headquarters.see.dashboard']) ? $headquarters->first()->name_headquarter : 'DASHBOARD');

        $appointmentReserves = MedicineReserve::query()
            ->select('status', DB::raw('count(*) as count'), 'dateReserve')
            ->groupBy('status', 'dateReserve')
            ->get();

        $appointmentReservesNow = $appointmentReserves ? $appointmentReserves->where('dateReserve', $date1) : '';
        $registradas = $appointmentReserves ? $appointmentReserves->sum('count') : '';
        $medicine =  round($registradas ? $registradas * 100 / $registradas : '0');
        return view('afac.dashboard.index', compact('date1', 'date2', 'registradas', 'medicine', 'nameHeadquarter'));
    }
}
