<?php

namespace App\Http\Controllers\afac;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function index()
    {


        Date::setLocale('ES');
        $date = Date::now()->parse();
        $appointment = MedicineReserve::query()
            ->selectRaw("count(id) as registradas")
            ->first();
        $registradas = $appointment->registradas;
        $medicine = ($registradas ? $registradas * 100 / $registradas : '0');
        return view('afac.dashboard.index', compact('date', 'registradas', 'medicine'));
    }
}
