<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public $catalogItems = [
        ['id' => 1, 'nama' => 'Canon 60D', 'kategori' => 'Kamera', 'harga' => 150000, 'stok' => 'Tersedia', 'deskripsi' => 'Kamera DSLR 18MP', 'gambar' => 'images/camera.png', 'nomor_rekening' => '1234567890'],
        ['id' => 2, 'nama' => 'Canon 18-55mm', 'kategori' => 'Lensa', 'harga' => 30000, 'stok' => 'Tidak Tersedia', 'deskripsi' => 'Lensa kit standar', 'gambar' => 'images/camera.png', 'nomor_rekening' => '1234567890'],
    ];
    public function landing() { return view('landing'); }

    public function dashboard()
    {
        $user = Auth::user();
        $rentalHistory = [
            ['tanggal' => '30 April', 'barang' => 'Canon 60D', 'harga' => 150000, 'penyewa' => 'Felix Edna', 'status' => 'Selesai'],
            ['tanggal' => '20 Mei', 'barang' => 'Canon 18-55mm', 'harga' => 30000, 'penyewa' => 'Felix Edna', 'status' => 'Selesai'],
        ];
        return view('admin.dashboard', compact('user', 'rentalHistory'));
    }
    public function dashboardPelanggan()
    {
        $user = Auth::user();
        $catalogItems = $this->catalogItems;
        return view('pelanggan.dashboardPelanggan', compact('user', 'catalogItems'));
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
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2000',
        ]);

        $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');

        // Add ke db nya yaa
        return back()->with('success', 'Bukti transfer berhasil diunggah!');
    }


    public function pengelolaan()
    {
        $user = Auth::user();
        $catalogItems = [
            ['id' => 1, 'nama' => 'Canon 60D', 'kategori' => 'Kamera', 'harga' => 150000, 'stok' => 'Tersedia', 'deskripsi' => 'Kamera DSLR 18MP', 'gambar' => 'images/camera.png'],
            ['id' => 2, 'nama' => 'Canon 18-55mm', 'kategori' => 'Lensa', 'harga' => 30000, 'stok' => 'Tidak Tersedia', 'deskripsi' => 'Lensa kit standar', 'gambar' => 'images/camera.png'],
        ];
        return view('pengelolaan', compact('user', 'catalogItems'));
    }

    public function riwayatBooking()
    {
        $user = Auth::user();
        $riwayat = [
            ['produk' => 'Kamera Canon EOS R5', 'tanggal' => '2025-05-20', 'durasi' => '2 Hari', 'status' => 'Selesai'],
            ['produk' => 'Lensa 50mm f/1.8', 'tanggal' => '2025-05-15', 'durasi' => '1 Hari', 'status' => 'Selesai'],
            ['produk' => 'Lighting Kit Godox', 'tanggal' => '2025-05-10', 'durasi' => '3 Hari', 'status' => 'Dibatalkan'],
        ];
        return view('riwayatBooking', compact('user', 'riwayat'));
    }

    public function riwayatAdmin()
    {
        $user = Auth::user();
        $rentalHistory = [
            ['tanggal' => '2025-05-25', 'barang' => 'Canon EOS 700D', 'harga' => 120000, 'penyewa' => $user->nama_lengkap, 'status' => 'Selesai'],
            ['tanggal' => '2025-05-30', 'barang' => 'Lensa 50mm f/1.8', 'harga' => 75000, 'penyewa' => $user->nama_lengkap, 'status' => 'Diproses'],
        ];

        return view('riwayatAdmin', compact('user', 'rentalHistory'));
    }
}

// public function profile
