<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // =========================
    // REGISTER
    // =========================

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([

            'name'=>'required',

            'email'=>'required|email|unique:users',

            'password'=>'required|min:6|confirmed'

        ]);

        User::create([

            'name'=>$request->name,

            'email'=>$request->email,

            'password'=>Hash::make($request->password),

            'role'=>'user'

        ]);

        return redirect('/login')
                ->with('success','Register berhasil.');
    }

    // =========================
    // LOGIN
    // =========================

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credential=$request->validate([

            'email'=>'required|email',

            'password'=>'required'

        ]);

        if(Auth::attempt($credential)){

            $request->session()->regenerate();

            if(Auth::user()->role=='admin'){

                return redirect('/admin');

            }
            return redirect()->route('dashboard');

        }

        return back()->withErrors([

            'email'=>'Email atau Password salah.'

        ]);
    }

    // =========================
    // LOGOUT
    // =========================

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}