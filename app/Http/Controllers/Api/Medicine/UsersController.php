<?php

namespace App\Http\Controllers\Api\Medicine;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = $request->password;

        $users->save();

        return response([
            "status" => 1,
            "message" => "éxitoso"
        ]);
    }
    public function list(Request $request)
    {
        // if ($request->header('Authorization') === 'Bearer 2|4ZWgUwhajRaJQyQv40tBvMVHzh1YU1EWN9GMTtGZ') {
            $userList = User::all();
            return response([
                "status" => 1,
                "message" => "Lista de usuarios",
                "data" => $userList
            ]);
        // } else {
        //     return response([
        //         "status" => 0,
        //         "message" => "No autorizado",
        //     ], 401);
        // }
    }
    public function show()
    {
    }
    public function update()
    {
    }
    public function delete()
    {
    }
}
