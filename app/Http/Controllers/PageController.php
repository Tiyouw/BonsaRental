<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public $catalogItems = [
        ['id' => 1, 'nama' => 'Canon 60D', 'kategori' => 'Kamera', 'harga' => 150000, 'stok' => 'Tersedia', 'deskripsi' => 'Kamera DSLR 18MP', 'gambar' => 'images/camera.png', 'nomor_rekening' => '1234567890'],
        ['id' => 2, 'nama' => 'Canon 18-55mm', 'kategori' => 'Lensa', 'harga' => 30000, 'stok' => 'Tidak Tersedia', 'deskripsi' => 'Lensa kit standar', 'gambar' => 'images/camera.png', 'nomor_rekening' => '1234567890'],
    ];
    public function landing() { return view('landing'); }

    public function detailProduk($id)
    {
        $username = $request->input('username');
        session(['username' => $username]);

        if ($username === 'admin') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('dashboardPelanggan');
        }
    }

    public function login() { return view('login'); }

    public function submitLogin(Request $request)
    {
        $username = $request->input('username');
        session(['username' => $username]);

        if ($username === 'admin') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('dashboardPelanggan');
        }
    }

    public function register() { return view('register'); }

    public function submitRegister(Request $request)
    {
        $username = $request->input('username');
        session(['username' => $username]);
        return redirect()->route('dashboardPelanggan');
    }

    public function dashboard()
    {
        $username = session('username', 'Admin');
        $rentalHistory = [
            ['tanggal' => '30 April', 'barang' => 'Canon 60D', 'harga' => 150000, 'penyewa' => 'Felix Edna', 'status' => 'Selesai'],
            ['tanggal' => '20 Mei', 'barang' => 'Canon 18-55mm', 'harga' => 30000, 'penyewa' => 'Felix Edna', 'status' => 'Selesai'],
        ];
        return view('dashboard', compact('username', 'rentalHistory'));
    }


    public function detailProduk($id)
    {
        // Cari produk berdasar id di data dummy catalogItems
        $produk = collect($this->catalogItems)->firstWhere('id', (int)$id);

        if (!$produk) {
            abort(404, "Produk tidak ditemukan");
        }

        return view('detailProduk', compact('produk'));
    }

    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:200000',
        ]);

        $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');

        // Add ke db nya yaa
        return back()->with('success', 'Bukti transfer berhasil diunggah!');
    }

    public function profile()
    {
        $username = session('username');
        return view('profile', compact('username'));
    }
    public function profilePelanggan(Request $request)
    {
        $username = $request->session()->get('username');
        return view('profilePelanggan', compact('username'));
    }

    public function pengelolaan()
    {
        $username = session('username', 'Pengguna');
        $catalogItems = [
            ['id' => 1, 'nama' => 'Canon 60D', 'kategori' => 'Kamera', 'harga' => 150000, 'stok' => 'Tersedia', 'deskripsi' => 'Kamera DSLR 18MP', 'gambar' => 'images/camera.png'],
            ['id' => 2, 'nama' => 'Canon 18-55mm', 'kategori' => 'Lensa', 'harga' => 30000, 'stok' => 'Tidak Tersedia', 'deskripsi' => 'Lensa kit standar', 'gambar' => 'images/camera.png'],
        ];
        return view('pengelolaan', compact('username', 'catalogItems'));
    }

    public function riwayatBooking()
    {
        $username = session('username', 'Pelanggan');
        $riwayat = [
            ['produk' => 'Kamera Canon EOS R5', 'tanggal' => '2025-05-20', 'durasi' => '2 Hari', 'status' => 'Selesai'],
            ['produk' => 'Lensa 50mm f/1.8', 'tanggal' => '2025-05-15', 'durasi' => '1 Hari', 'status' => 'Selesai'],
            ['produk' => 'Lighting Kit Godox', 'tanggal' => '2025-05-10', 'durasi' => '3 Hari', 'status' => 'Dibatalkan'],
        ];
        return view('riwayatBooking', compact('username', 'riwayat'));
    }

    public function riwayatAdmin()
    {
        $username = session('username', 'Admin');

        $rentalHistory = [
            ['tanggal' => '2025-05-25', 'barang' => 'Canon EOS 700D', 'harga' => 120000, 'penyewa' => $username, 'status' => 'Selesai'],
            ['tanggal' => '2025-05-30', 'barang' => 'Lensa 50mm f/1.8', 'harga' => 75000, 'penyewa' => $username, 'status' => 'Diproses'],
        ];

        return view('riwayatAdmin', compact('username', 'rentalHistory'));
    }
}

// public function profile
