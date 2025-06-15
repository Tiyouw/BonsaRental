<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function submit(Request $request)
    {
        $username = $request->input('username');
        session(['username' => $username]);

        if ($username === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('dashboardPelanggan');
        }
    }

    public function login() { return view('auth.login'); }

    public function submitLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->username === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('dashboardPelanggan');
            }
        }

        return back()->withErrors([
            'username' => 'Login gagal. Username atau password salah.',
        ])->onlyInput('username');
    }

    public function register() { return view('auth.register'); }

    public function submitRegister(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'nama_lengkap' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        Auth::login($user);
        return redirect()->route('pelanggan.dashboardPelanggan');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing')->with('success', 'Berhasil logout.');
    }
}
