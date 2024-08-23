<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PesertaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentPhase = config('game.current_phase');
        if (Auth::check() && Auth::user()->role == 'peserta') {
            switch ($currentPhase) {
                case 'tugupahlawan':
                    if (!$request->is('peserta/tugupahlawan')) {
                        return redirect()->route('peserta.tugupahlawan')->with('error', 'Anda hanya bisa mengakses Tugu Pahlawan saat ini.');
                    }
                    break;
    
                case 'kotalama':
                    if (!$request->is('peserta/kotalama')) {
                        return redirect()->route('peserta.kotalama')->with('error', 'Anda hanya bisa mengakses Kota Lama saat ini.');
                    }
                    break;
    
                case 'ubaya':
                    if (!$request->is('peserta/ubaya')) {
                        return redirect()->route('peserta.ubaya')->with('error', 'Anda hanya bisa mengakses Ubaya saat ini.');
                    }
                    break;
    
                default:
                    return abort(403, 'Fase game tidak valid.');
            }
            return $next($request);
        }
        if (auth()->guest()) {
            return redirect(route('login'));
        }

        abort(404);
    }
}
