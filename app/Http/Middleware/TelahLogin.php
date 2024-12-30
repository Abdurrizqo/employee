<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TelahLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa login pada masing-masing guard
        if (Auth::guard('guard_super_admin')->check()) {
            return redirect('/super-admin/dashboard');
        } elseif (Auth::guard('guard_admin')->check()) {
            return redirect('/admin/dashboard');
        } elseif (Auth::guard('guard_user')->check()) {
            return redirect('/dashboard');
        }

        // Jika tidak ada yang login, lanjutkan permintaan
        return $next($request);
    }
}
