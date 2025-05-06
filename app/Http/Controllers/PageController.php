<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // For the landing page
    public function landing()
    {
        return view('landing');
    }

    // For the login page
    public function login()
    {
        return view('login');
    }

    // For the dashboard page
    public function dashboard(Request $request)
    {
        $username = $request->query('username', 'Pengguna');

        // Sample rental history data for the dashboard
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

    // For the profile page
    public function profile(Request $request)
    {
        $username = $request->query('username', 'Pengguna');

        return view('profile', compact('username'));
    }

    // For the pengelolaan page
    public function pengelolaan()
    {
        // Sample catalog data
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

        return view('pengelolaan', compact('catalogItems'));
    }
}
