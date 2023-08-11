<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ValidateEncryptedUrl
{
    public function handle(Request $request, Closure $next)
    {
        $keyEncrypt = $request->route('keyEncrypt');
        try {
            Crypt::decryptString($keyEncrypt);
            return $next($request);
        } catch (\Exception $e) {
            throw new NotFoundHttpException(); // Throw a 404 exception
        }
    }
}
