<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function submit(Request $request)
    {
        $username = $request->input('username');
        return redirect()->route('dashboard', compact('username'));
    }

    public function dashboard(Request $request)
    {
        $username = $request->query('username', 'Pengguna');

        $rentalHistory = [
            [
                'tanggal' => '30 April',
                'barang' => 'Canon 60D',
                'harga' => 150000,
                'penyewa' => 'Felix Edna',
                'status' => 'Selesai'
            ],
            [
                'tanggal' => '20 Mei',
                'barang' => 'Canon 18-55mm',
                'harga' => 30000,
                'penyewa' => 'Felix Edna',
                'status' => 'Selesai'
            ],
            [
                'tanggal' => '30 April',
                'barang' => 'Canon 60D',
                'harga' => 150000,
                'penyewa' => 'Felix Edna',
                'status' => 'Selesai'
            ],
            [
                'tanggal' => '20 Mei',
                'barang' => 'Canon 18-55mm',
                'harga' => 30000,
                'penyewa' => 'Felix Edna',
                'status' => 'Selesai'
            ],
        ];

        return view('dashboard', compact('username', 'rentalHistory'));
    }

    public function profile(Request $request)
    {
        $username = $request->query('username');

        return view('profile', ['username' => $username]);
    }

    public function pengelolaan(Request $request)
    {
        $username = $request->query('username', 'Pengguna');
        $catalogItems = [
            [
                'id' => 1,
                'nama' => 'Canon 60D',
                'kategori' => 'Kamera',
                'harga' => 150000,
                'stok' => 5,
                'deskripsi' => 'Kamera DSLR 18MP dengan layar LCD yang dapat diputar',
                'gambar' => 'images/camera.png'
            ],
            [
                'id' => 2,
                'nama' => 'Canon 18-55mm',
                'kategori' => 'Lensa',
                'harga' => 30000,
                'stok' => 8,
                'deskripsi' => 'Lensa kit standar untuk kamera Canon DSLR',
                'gambar' => 'images/camera.png'
            ],
            [
                'id' => 3,
                'nama' => 'Sony A7 III',
                'kategori' => 'Kamera',
                'harga' => 250000,
                'stok' => 3,
                'deskripsi' => 'Kamera mirrorless full-frame dengan autofocus cepat',
                'gambar' => 'images/camera.png'
            ],
            [
                'id' => 4,
                'nama' => 'Tripod Manfrotto',
                'kategori' => 'Aksesoris',
                'harga' => 50000,
                'stok' => 10,
                'deskripsi' => 'Tripod kokoh untuk berbagai jenis kamera',
                'gambar' => 'images/camera.png'
            ],
            [
                'id' => 5,
                'nama' => 'Godox TT685',
                'kategori' => 'Lighting',
                'harga' => 75000,
                'stok' => 6,
                'deskripsi' => 'Flash eksternal dengan TTL dan mode HSS',
                'gambar' => 'images/camera.png'
            ],
        ];

        return view('pengelolaan', compact('username','catalogItems'));
    }
}
