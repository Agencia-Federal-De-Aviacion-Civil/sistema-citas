<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserMedicineController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super_admin|super_admin_medicine']);
    }
    public function index(){
        return view('afac.users.index');
    }
}
