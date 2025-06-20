<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking; // Import the Booking model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $user = Auth::user(); // Get the authenticated user

        // Fetch recent booking history for the dashboard display
        // Limit to, for example, 5 recent bookings
        $recentBookings = Booking::with(['user', 'detailBookings.produk'])
                                 ->orderBy('created_at', 'desc')
                                 ->limit(5) // Limit the number of records for dashboard snippet
                                 ->get();

        // Format data for $rentalHistory as expected by the view
        $rentalHistory = $recentBookings->map(function($booking) {
            // Assuming each booking has at least one detail booking
            $productNames = $booking->detailBookings->map(function($detail) {
                return $detail->produk->nama_produk;
            })->implode(', '); // Join multiple product names if a booking has multiple items

            return [
                'id_booking' => $booking->id_booking, // Tambahkan ID booking untuk link detail jika diperlukan
                'tanggal' => \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y'),
                'barang' => $productNames,
                'harga' => $booking->total_harga,
                'penyewa' => $booking->user->nama_lengkap,
                'status_booking' => $booking->getStatusBookingLabel(), // Ambil label dan warna status booking
                'status_sewa' => $booking->getStatusSewaLabel(),     // Ambil label dan warna status sewa
            ];
        })->toArray(); // Convert to array if the view expects an array, not a collection

        // Pass data to the view
        return view('admin.dashboard', compact('user', 'rentalHistory'));
    }
}
