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

        $headquarters = cache()->remember('headquarters_' . Auth::user()->id, 120, function () {
            $query = Headquarter::with([
                'HeadquarterUserHeadquarter.userHeadquarterUserParticipant'
            ]);

            if (Auth::user()->canany(['headquarters.see.dashboard', 'sub_headquarters.see.dashboard'])) {
                $query->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
                    $q1->where('user_id', Auth::user()->id);
                });
            }

            return $query->get();
        });

        $nameHeadquarter = $headquarters->isNotEmpty() ? $headquarters->first()->name_headquarter : 'DASHBOARD';

        $appointmentReserves = cache()->remember('appointment_reserves', 120, function () {
            return MedicineReserve::query()
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->get()
                ->map(function ($item) {
                    return [
                        'status' => $item->status,
                        'count' => $item->count,
                        'dateReserve' => $item->dateReserve,
                    ];
                });
        });

        $appointmentReservesNow = $appointmentReserves->where('dateReserve', $date1);
        $registradas = $appointmentReserves->sum('count');
        $medicine = $registradas > 0 ? round($registradas * 100 / $registradas) : 0;

        return view('afac.dashboard.index', compact('date1', 'date2', 'registradas', 'medicine', 'nameHeadquarter'));
    }
}
