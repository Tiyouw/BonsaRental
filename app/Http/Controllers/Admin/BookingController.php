<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $bookings = Booking::with(['user', 'detailBookings.produk'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin/riwayatAdmin', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::with(['user', 'detailBookings.produk'])
            ->findOrFail($id);

        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatusBooking(Request $request, $id)
    {
        $request->validate([
            'status_booking' => 'required|in:diproses,disetujui,ditolak'
        ]);

        $booking = Booking::findOrFail($id);

        // If rejecting a booking that was previously approved, return products to stock
        if ($request->status_booking == 'ditolak' && $booking->status_booking == 'disetujui') {
            foreach ($booking->detailBookings as $detail) {
                $detail->produk->increment('stock', $detail->jumlah);
            }
        }

        // If approving a booking, check if products are still available
        if ($request->status_booking == 'disetujui' && $booking->status_booking == 'diproses') {
            foreach ($booking->detailBookings as $detail) {
                if ($detail->produk->stock < $detail->jumlah) {
                    return back()->with('error', 'Stok produk ' . $detail->produk->nama_produk . ' tidak mencukupi.');
                }
                // Decrease stock when booking is approved
                $detail->produk->decrement('stock', $detail->jumlah);
            }
        }

        $booking->status_booking = $request->status_booking;
        $booking->save();

        return redirect()->route('admin.bookings.show', $booking->id_booking)
            ->with('success', 'Status booking berhasil diperbarui.');
    }

    public function updateStatusSewa(Request $request, $id)
    {
        $request->validate([
            'status_sewa' => 'required|in:belum_disewa,disewa,dikembalikan'
        ]);

        $booking = Booking::findOrFail($id);

        // Only allow status update if booking is approved
        if ($booking->status_booking !== 'disetujui') {
            return back()->with('error', 'Status sewa hanya dapat diubah untuk booking yang disetujui.');
        }

        // If item is being returned, return products to stock
        if ($request->status_sewa == 'dikembalikan' && $booking->status_sewa == 'disewa') {
            foreach ($booking->detailBookings as $detail) {
                $detail->produk->increment('stock', $detail->jumlah);
            }
        }

        $booking->status_sewa = $request->status_sewa;
        $booking->save();

        return redirect()->route('admin.bookings.show', $booking->id_booking)
            ->with('success', 'Status sewa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        // Return products to stock if booking was approved and items weren't returned
        if ($booking->status_booking == 'disetujui' && $booking->status_sewa != 'dikembalikan') {
            foreach ($booking->detailBookings as $detail) {
                $detail->produk->increment('stock', $detail->jumlah);
            }
        }

        $booking->delete();

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking berhasil dihapus.');
    }
}
