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
            // $appointmentReserves = MedicineReserve::with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
            //     ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
            //         $q1->where('user_id', Auth::user()->id);
            //     })
            //     ->select('status', DB::raw('count(*) as count'), 'dateReserve')
            //     ->groupBy('status', 'dateReserve')
            //     ->get();
            // $headquarters = Headquarter::with([
            //     'HeadquarterUserHeadquarter.userHeadquarterUserParticipant'
            // ])->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q2) {
            //     $q2->where('user_id', Auth::user()->id);
            // })->get();
            // $nameHeadquarter = $headquarters->pluck('name_headquarter')->first();
        } else if (Auth::user()->can('sub_headquarters.see.dashboard')) {
            // $appointmentReserves = MedicineReserve::with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
            //     ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q3) {
            //         $q3->where('user_id', Auth::user()->id);
            //     })
            //     ->select('status', DB::raw('count(*) as count'), 'dateReserve')
            //     ->groupBy('status', 'dateReserve')
            //     ->where('headquarter_id', 6)
            //     ->where('dateReserve', $date1)
            //     ->get();
            // $headquarters = Headquarter::with([
            //     'HeadquarterUserHeadquarter.userHeadquarterUserParticipant'
            // ])->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q2) {
            //     $q2->where('user_id', Auth::user()->id);
            // })->get();
        } else {
            // TODO FUNCIONA
            $appointmentReserves = MedicineReserve::query()
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->get();
            // $headquarters = Headquarter::with([
            //     'headquarterMedicineReserve:id,headquarter_id,medicine_id,dateReserve'
            // ])->where('is_external', false)->get(['id', 'medicine_schedule_id', 'name_headquarter', 'is_external']);
        }

        $appointmentReservesNow = $appointmentReserves->where('dateReserve', $date1);
        $registradas = $appointmentReserves->sum('count');
        $medicine =  round($registradas ? $registradas * 100 / $registradas : '0');
        return view('afac.dashboard.index', compact('date1', 'date2', 'registradas', 'medicine'));
    }
}
