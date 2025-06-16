<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $rentalHistory = Booking::with(['user', 'detailBookings.produk']) // <-- Tambahkan eager loading untuk detailBookings.produk
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($booking) {
                // Ambil nama produk dari detail booking pertama (jika ada)
                // Jika booking bisa punya banyak produk, ini perlu disesuaikan untuk menampilkan semua produk
                $productNames = $booking->detailBookings->map(function($detail) {
                    return $detail->produk->nama_produk ?? 'Unknown Produk';
                })->implode(', '); // Menggabungkan nama-nama produk dengan koma

                // Perhatikan juga 'status' di sini. Model Booking memiliki 'status_booking' dan 'status_sewa'.
                // Sesuaikan mana yang ingin Anda tampilkan.
                $statusLabel = $booking->getStatusBookingLabel(); // Memanggil helper dari model Booking

                return [
                    'tanggal' => $booking->created_at->format('d M Y'),
                    'barang' => $productNames, // <-- Gunakan productNames yang sudah digabungkan
                    'harga' => $booking->total_harga,
                    'penyewa' => $booking->user->nama_lengkap ?? 'Unknown User', // Menggunakan nama_lengkap
                    'status' => $statusLabel['text'] // Menggunakan helper status booking
                ];
            });

        return view('admin.dashboard', compact('user', 'rentalHistory'));
    }
}
