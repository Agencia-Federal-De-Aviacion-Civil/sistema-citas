<?php

namespace App\Http\Controllers\afac;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function index(){
        
        
        Date::setLocale('ES');
        $date = Date::now()->parse();
        return view('afac.dashboard.index',compact('date'));
    }
}
