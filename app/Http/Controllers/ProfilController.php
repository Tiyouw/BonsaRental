<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('pelanggan.profilePelanggan', compact('user'));
    }

    public function profilePelanggan(Request $request)
    {
        $user = Auth::user();
        return view('pelanggan.profilePelanggan', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('pelanggan.EditProfil', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:20000',
        ]);

        $user = Auth::user();

        if ($request->hasFile('gambar')) {
            if ($user->gambar && Storage::disk('public')->exists($user->gambar)) {
                Storage::disk('public')->delete($user->gambar);
            }

            $user->gambar = $request->file('gambar')->store('gambar_profile', 'public');
        }

        $user->update([
            'username' => $request->username,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'gambar' => $request->gambar,
        ]);

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
            'username' => 'required|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:20000',
        ]);

        $user = Auth::user();

        if ($request->hasFile('gambar')) {
            if ($user->gambar && Storage::disk('public')->exists($user->gambar)) {
                Storage::disk('public')->delete($user->gambar);
            }

            $user->gambar = $request->file('gambar')->store('gambar_profile', 'public');
        }

        $user->update([
            'username' => $request->username,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'gambar' => $user->gambar,
        ]);

        return redirect()->route('admin.profile')->with('success', 'Profil admin berhasil diperbarui.');
    }

}

