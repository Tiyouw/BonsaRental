<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;



class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(LoginRequest $request)
    {
        try {
            $request->authenticate();
            $request->session()->regenerate();

            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('katalog');
        } catch (ValidationException $e) {
            return back()->withErrors([
                'username' => 'Username atau password yang dimasukkan salah.',
            ])->onlyInput('username');
        }
    }

    /**
     * Show the registration form
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'customer'; // Default role for new registrations

        $user = User::create($data);

        Auth::login($user);

        return redirect()->route('katalog');
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Show user profile
     */
    public function showProfile()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . Auth::id()],
            'no_hp' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:15'],
            'alamat' => ['required', 'string'],
            'current_password' => ['nullable', 'required_with:new_password'],
            'new_password' => ['nullable', 'min:8', 'confirmed']
        ]);

        $user = Auth::user();

        // Handle password update if provided
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
            }
            $data['password'] = Hash::make($request->new_password);
        }

        // Remove password fields from data before update
        unset($data['current_password']);
        unset($data['new_password']);

        // Handle file upload if provided
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('public/profile-photos');
            $data['gambar'] = str_replace('public/', '', $path);
        }

        $user->update($data);

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}
