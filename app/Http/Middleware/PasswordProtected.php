<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PasswordProtected
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah password sudah diverifikasi
        if (!Session::get('password_verified', false)) {
            return redirect()->route('password.verify'); // Redirect ke modal password jika belum diverifikasi
        }

        return $next($request);
    }
}
