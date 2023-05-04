<?php

namespace App\Http\Controllers\afac\schedule;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class userMedicine extends Controller
{
    public function index()
    {

        $permises = Permission::all();
        return view('afac.users.index');
    }
}
