<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function show()
    {
        $user = \App\Models\User::find(Auth::id());
        return view('pelanggan.profilePelanggan', compact('user'));
    }

    public function profilePelanggan(Request $request)
    {
        $user = \App\Models\User::find(Auth::id());
        return view('pelanggan.profilePelanggan', compact('user'));
    }

    public function edit()
    {
        $user = \App\Models\User::find(Auth::id());
        return view('pelanggan.EditProfil', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => 'string|max:255',
            'nama_lengkap' => 'string|max:255',
            'no_hp' => 'string|max:20',
            'alamat' => 'string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:20000',
        ]);

        $user = \App\Models\User::find(Auth::id());

        if ($request->hasFile('gambar')) {
            if ($user->gambar && Storage::disk('public')->exists($user->gambar)) {
                Storage::disk('public')->delete($user->gambar);
            }

            $user->gambar = $request->file('gambar')->store('gambar_profile', 'public');
        }

        $user->username = $request->username;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;
        $user->gambar = $user->gambar;
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function editAdmin()
    {
        $user = Auth::user();
        return view('admin.editProfileAdmin', compact('user'));
    }

    public function updateAdmin(Request $request)
    {
        $request->validate([
            'username' => 'string|max:255',
            'nama_lengkap' => 'string|max:255',
            'no_hp' => 'string|max:20',
            'alamat' => 'string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:20000',
        ]);

        $user = \App\Models\User::find(Auth::id());

        if ($request->hasFile('gambar')) {
            if ($user && $user->gambar && Storage::disk('public')->exists($user->gambar)) {
                Storage::disk('public')->delete($user->gambar);
            }

            if ($user) {
                $user->gambar = $request->file('gambar')->store('gambar_profile', 'public');
            }
        }

        if ($user) {
            $user->username = $request->username;
            $user->nama_lengkap = $request->nama_lengkap;
            $user->no_hp = $request->no_hp;
            $user->alamat = $request->alamat;
            $user->gambar = $user->gambar;
            $user->save();
            return redirect()->route('admin.profile')->with('success', 'Profil admin berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }
    }

}

