<?php

namespace App\Http\Controllers\afac\schedule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super_admin|user']);
    }
    public function index()
    {
        return view('afac.schedule.index');
    }
}
