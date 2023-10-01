<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected function showLogin()
    {
        $data = [
            'title' => 'Login',
        ];

        return view('auth.login', $data);
    }

    protected function handleLogin(Request $request)
    {
        $credentials = $this->validate($request, [
            'username'  => 'required',
            'password'  => 'required',
        ], [
            'username.required' => 'Username tidak boleh kosong!',
            'password.required' => 'Password tidak boleh kosong!',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('overview');
        }

        return back()->with('error', 'Akun tidak ditemukan!');
    }

    protected function handleLogout()
    {
        Auth::logout();
        return redirect()->route('login')->with('warning', 'Anda telah keluar!');
    }
}
