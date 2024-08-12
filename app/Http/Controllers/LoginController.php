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

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = DB::table('users')->where('name', $request->input('name'))->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {

            Auth::loginUsingId($user->id);

            if ($user->role == 'penpos') {
                return redirect()->intended()->route("penpos.dashboard");
            } elseif ($user->role === 'peserta') {
                return redirect()->route("peserta_dashboard");
            }
        }

        return back()->withErrors([
            'name' => 'Invalid credentials.',
        ]);
    }
    
}
