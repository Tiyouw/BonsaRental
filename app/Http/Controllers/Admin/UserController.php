<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User; // Pastikan model User diimpor

class UserController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view('admin.EditProfileAdmin', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */ // <-- Type hint ditambahkan di sini
        $user = auth()->user();

        $validatedData = $request->validate([
            'nama_lengkap' => 'string|max:255',
            // 'email' => 'email|unique:users,email,' . $user->id, // Dihapus karena email tidak digunakan
            'no_hp' => 'string|max:15',
            'alamat' => 'string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada sebelum menyimpan yang baru
            if ($user->gambar && Storage::disk('public')->exists($user->gambar)) {
                Storage::disk('public')->delete($user->gambar);
            }
            $gambar = $request->file('gambar')->store('profile-images', 'public');
            $user->gambar = $gambar;
        }

        $user->nama_lengkap = $validatedData['nama_lengkap'];
        // $user->email = $validatedData['email']; // Dihapus karena email tidak digunakan
        $user->no_hp = $validatedData['no_hp'];
        $user->alamat = $validatedData['alamat'];

        // Update password if provided
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui');
    }
}
