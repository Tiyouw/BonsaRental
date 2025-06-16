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
        $rentalHistory = Booking::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($booking) {
                return [
                    'tanggal' => $booking->created_at->format('d M Y'),
                    'barang' => $booking->produk->nama_produk ?? 'Unknown',
                    'harga' => $booking->total_harga,
                    'penyewa' => $booking->user->nama_lengkap ?? 'Unknown',
                    'status' => $booking->status
                ];
            });

        return view('admin.dashboard', compact('user', 'rentalHistory'));
    }
}
