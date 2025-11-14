<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {

            // jika status bukan 'approved'
            if (Auth::user()->status !== 'approved') {
                Auth::logout();
                return redirect('/login')->with('error', 'Akun Anda sedang dinonaktifkan.');
            }
        }

        return $next($request);
    }
}
