<?php

namespace App\Http\Controllers\afac;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use App\Models\Medicine\MedicineReserve;
use App\Models\Catalogue\Headquarter;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public $headquarters;
    public function index()
    {
        Date::setLocale('ES');
        $date = Date::now()->parse();
        $date1 = Date::now()->format('Y-m-d');
        $appointment = MedicineReserve::query()
            ->selectRaw("count(id) as registradas")
            ->selectRaw("count(case when status = '0' then 1 end) as pendientes")
            ->selectRaw("count(case when status = '1' then 1 end) as validado")
            ->selectRaw("count(case when status = '2' then 1 end) as canceladosede")
            ->selectRaw("count(case when status = '3' then 1 end) as canceladousuario")
            ->selectRaw("count(case when status = '4' then 1 end) as reagendado")
            // ->selectRaw("count(case when dateReserve = ? then 1 end) as appointmentnow", [$date1])
            // ->selectRaw("count(id) as registradasfull")
            // ->where('dateReserve', $date1)
            ->first();
        //ADMIN MEDICINE
        $registradas = $appointment->registradas;
        $pendientes = $appointment->pendientes;
        $validado = $appointment->validado;
        $reagendado = $appointment->reagendado;
        $canceladas = $appointment->canceladosede + $appointment->canceladousuario;
        $porconfir = $appointment && $appointment->registradas > 0
            ? round(($appointment->validado * 100 / $appointment->registradas), 0)
            : 0;
        $porpendientes = $appointment && $appointment->registradas > 0
            ? round(($appointment->pendientes * 100 / $appointment->registradas), 0)
            : 0;
        $porreagendado = $appointment && $appointment->registradas > 0
            ? round(($appointment->reagendado * 100 / $appointment->registradas), 0)
            : 0;
        $porcanceladas1 = $appointment && $appointment->registradas > 0
            ? round(($appointment->canceladas * 100 / $appointment->registradas), 0)
            : 0;
        $porcanceladas = $appointment && $appointment->registradas > 0
            ? round(($canceladas * 100 / $registradas), 0)
            : 0;
        //dd($canceladas* 100 / $registradas);
        // $nowapoimnet = $appointment->appointmentnow;
        //SUPER ADMIN
        $registradasall = $appointment->registradasfull;
        $medicine = ($registradasall ? $registradasall * 100 / $registradasall : '0');



        /* $headquarters = MedicineReserve::with([
            'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser'
        ])->get();*/
        $headquarters = Headquarter::with([
            'headquarterUser'
        ])->get();
        return view('afac.dashboard.index', compact('date', 'registradasall', 'medicine', 'registradas', 'pendientes', 'validado', 'reagendado', 'canceladas', 'porconfir', 'porpendientes', 'porreagendado', 'porcanceladas1', 'porcanceladas', 'date1', 'headquarters'));
    }
}
