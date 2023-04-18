<?php

namespace App\Http\Controllers\afac;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use App\Models\Medicine\MedicineReserve;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public $validad, $cancelada, $registradas;
    protected $listeners = ['createRequest' => 'mount'];    
    
    public function index(){
        
        
        Date::setLocale('ES');
        $date = Date::now()->parse();
        
        $appointment = MedicineReserve::query()
        ->selectRaw("count(id) as registradas")
        ->first();
        $registradas = $appointment->registradas;
        return view('afac.dashboard.index',compact('date','registradas'));
        
    }
    
}
