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
        // $roles = Role::all();

        $permises = Permission::all();        

        // role_has_permissions
        // $user=User::with(['roles'])->findOrFail(1);
        // $role=$user['roles'];

        // $user=User::with(['roles'])->findOrFail(1);

        // $roles=Role::get()->pluck('name');

            // dd($user->roles[0]->name);

        return view('afac.users.index');
    }
}
