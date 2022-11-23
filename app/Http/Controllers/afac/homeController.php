<?php

namespace App\Http\Controllers\afac;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index(){
        return view('afac.dashboard.index');
    }
}
