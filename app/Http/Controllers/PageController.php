<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;     // Import Model Produk
use App\Models\Penyewaan;  // Import Model Penyewaan
use App\Models\User;      // Import Model User (untuk register dan otentikasi)
use Illuminate\Support\Facades\Auth; // Untuk otentikasi Laravel
use Illuminate\Support\Facades\Session; // Untuk logout

class PageController extends Controller
{

    public function landing()
    {
        return view('landing');
    }

    public function login()
    {
        return view('login');
    }

 public function submitLogin(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required|string', // Ini adalah nama input dari form HTML
        'password' => 'required|string',
    ]);

    // UBAH: Gunakan 'name' sebagai nama kolom di database
    if (Auth::attempt(['name' => $credentials['username'], 'password' => $credentials['password']])) {
        $request->session()->regenerate();

        if (Auth::user()->role === 'admin') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('dashboardPelanggan');
        }
    }

    return back()->withErrors([
        'username' => 'Username atau password salah.',
    ])->onlyInput('username');
}

    public function register()
    {
        return view('register');
    }

   public function submitRegister(Request $request)
{
    $request->validate([
        // UBAH: Cek keunikan di kolom 'name'
        'username' => 'required|string|max:255|unique:users,name',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
    ]);

    $user = User::create([
        // UBAH: Simpan nilai dari input 'username' ke kolom 'name' di database
        'name' => $request->username,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'pelanggan',
    ]);

    Auth::login($user);
    return redirect()->route('dashboardPelanggan');
}

    public function dashboard()
    {
        // Pastikan hanya admin yang bisa mengakses dashboard ini
        // Sebaiknya juga dilindungi dengan middleware di route
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.'); // Atau redirect ke halaman lain
        }

        $username = Auth::user()->username; // Ambil username dari user yang sedang login

        // Ambil semua riwayat penyewaan dari database, termasuk data user dan produk terkait
        $rentalHistory = Penyewaan::with(['user', 'produk'])
                                   ->orderBy('created_at', 'desc') // Urutkan berdasarkan waktu terbaru
                                   ->get();

        return view('dashboard', compact('username', 'rentalHistory'));
    }

    public function dashboardPelanggan()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $username = Auth::user()->username; // Ambil username dari user yang sedang login

        // Ambil semua produk dari database
        $catalogItems = Produk::all();

        return view('dashboardPelanggan', compact('username', 'catalogItems'));
    }

    public function detailProduk($id)
    {
        // Cari produk berdasarkan ID di database, akan otomatis 404 jika tidak ditemukan
        $produk = Produk::findOrFail($id);

        return view('detailProduk', compact('produk'));
    }

    public function uploadBukti(Request $request, $id)
    {
        // Validasi file yang diunggah
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB (2048 KB)
        ]);

        // Simpan file bukti transfer ke storage
        $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');

        $penyewaan = Penyewaan::find($id);

        if ($penyewaan) {
            $penyewaan->bukti_transfer_path = $path; // Simpan path ke kolom database
            $penyewaan->status = 'menunggu_konfirmasi_admin'; // Ubah status penyewaan
            $penyewaan->save();
            return back()->with('success', 'Bukti transfer berhasil diunggah! Mohon tunggu konfirmasi admin.');
        }

        return back()->with('error', 'Transaksi tidak ditemukan atau terjadi kesalahan.');
    }

    public function profile()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user(); // Ambil objek user yang sedang login
        return view('profile', compact('user')); // Kirim seluruh objek user ke view
    }

    public function profilePelanggan(Request $request)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user(); // Ambil objek user yang sedang login
        return view('profilePelanggan', compact('user')); // Kirim seluruh objek user ke view
    }

    public function pengelolaan()
    {
        // Pastikan hanya admin yang bisa mengakses halaman ini
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $username = Auth::user()->username; // Ambil username dari user yang sedang login
        $catalogItems = Produk::all(); // Ambil semua produk dari database

        return view('pengelolaan', compact('username', 'catalogItems'));
    }

    public function riwayatBooking()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $username = Auth::user()->username;
        // Ambil riwayat booking user yang sedang login dari database, termasuk data produk terkait
        $riwayat = Penyewaan::where('user_id', Auth::id()) // Hanya ambil penyewaan milik user yang login
                               ->with('produk') // Load relasi produk
                               ->orderBy('created_at', 'desc')
                               ->get();

        return view('riwayatBooking', compact('username', 'riwayat'));
    }

    public function riwayatAdmin()
    {
        // Pastikan hanya admin yang bisa mengakses halaman ini
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $username = Auth::user()->username;
        // Ambil semua riwayat penyewaan dari database, termasuk data user dan produk terkait
        $rentalHistory = Penyewaan::with(['user', 'produk'])
                                   ->orderBy('created_at', 'desc')
                                   ->get();

        return view('riwayatAdmin', compact('username', 'rentalHistory'));
    }

    // Metode logout yang sesuai dengan otentikasi Laravel
    public function logout(Request $request)
    {
        Auth::logout(); // Logout user dari sesi

        $request->session()->invalidate(); // Invalidasi sesi
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}
