<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    { 
        return view('login');
    }

    public function logout(Request $request){
        Auth::guard("web")->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view("login");

    }

    public function login(Request $request)
    {
        $currentPhase = config('game.current_phase');
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('name', 'password'))) {
            return back()->withErrors([
                'gagal' => 'Invalid credentials.',
            ]);
        }

        $request->session()->regenerate();

        switch (Auth::user()->role) {
            case 'penpos':
                return redirect()->intended('penpos/dashboard');
            case 'peserta':
                return redirect()->intended('peserta/' . $currentPhase); // Ini bisa diubah2 sesuai gamenya
            default:
                return redirect()->route('login'); // Jika ada role yang tidak dikenali
        }
    }
}
