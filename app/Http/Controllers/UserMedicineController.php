<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserMedicineController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super_admin|super_admin_medicine|admin_medicine_v2|admin_medicine_v3']);
    }
    public function index()
    {
        return view('afac.users.index');
    }
}
