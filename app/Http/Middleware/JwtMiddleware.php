<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // TODO Se Valida el Token Ingresado en la Petición
    public function handle(Request $request, Closure $next): Response
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (TokenInvalidException $e) {
            return $this->unauthorized('El Token Es Inválido');
        } catch (TokenExpiredException $e) {
            return $this->unauthorized('El Token Expiro');
        } catch (JWTException $e) {
            return $this->unauthorized('No Se Ingreso Ningún Token');
        }
        return $next($request);
    }
    private function unauthorized($message)
    {
        return response()->json([
            'message' => $message ? $message : 'Acceso No Autorizado',
            'status' => false
        ]);
    }
}
