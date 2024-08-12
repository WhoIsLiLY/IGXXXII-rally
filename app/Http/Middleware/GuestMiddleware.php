<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guest()) {
            return $next($request);
        } else if (Auth::check()) {

            if (Auth::user()->role == 'peserta') {
                return redirect(route('peserta.dashboard'));
            } else if (Auth::user()->role == 'penpos') {
                return redirect(route('penpos.dashboard'));
            }
        }

    }
}
