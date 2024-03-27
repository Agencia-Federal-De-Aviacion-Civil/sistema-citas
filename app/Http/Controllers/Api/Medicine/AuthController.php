<?php

namespace App\Http\Controllers\Api\Medicine;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['afac.login', 'login']]);
    }
    public function login (Request $request)
    {
        $this->validate($request, [
            'login' => 'required',
            'password' => 'required'
        ]);
        try {
            $credentials = ([
                'email' => request('login'),
                'password' => request('password')
            ]);
            if (! $token = auth('api')->attempt($credentials)) {
                return response()->json(['error' => 'Credenciales Invalidas'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'No Autorizado'], 401);
        }
        return response()->json([
            'token' => $token
        ]);
    }
}
