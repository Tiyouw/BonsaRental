<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\DetailBooking;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function form($id)
    {
        $product = Produk::findOrFail($id);
        
        if ($product->stock <= 0) {
            return redirect()->route('katalog')
                ->with('error', 'Maaf, produk ini sedang tidak tersedia.');
        }

        return view('booking.form', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produks,id_produk',
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after:tanggal_booking',
            'jumlah' => 'required|integer|min:1',
            'bukti_pembayaran' => 'required|image|max:2048'
        ]);

        try {
            DB::beginTransaction();

            $product = Produk::findOrFail($request->id_produk);

            // Check stock availability
            if ($product->stock < $request->jumlah) {
                return back()->with('error', 'Jumlah unit yang diminta melebihi stok yang tersedia.');
            }

            // Calculate total price
            $days = \Carbon\Carbon::parse($request->tanggal_booking)
                ->diffInDays(\Carbon\Carbon::parse($request->tanggal_kembali));
            $totalHarga = $product->harga_per_hari * $request->jumlah * $days;

            // Handle bukti pembayaran upload
            $buktiPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

            // Create booking
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'tanggal_booking' => $request->tanggal_booking,
                'tanggal_kembali' => $request->tanggal_kembali,
                'total_harga' => $totalHarga,
                'status_booking' => 'diproses',
                'status_sewa' => 'belum_disewa',
                'bukti_pembayaran' => $buktiPath
            ]);

            // Create detail booking
            DetailBooking::create([
                'id_booking' => $booking->id_booking,
                'id_produk' => $request->id_produk,
                'jumlah' => $request->jumlah,
                'subtotal' => $totalHarga
            ]);

            DB::commit();

            return redirect()->route('riwayatBooking')
                ->with('success', 'Booking berhasil dibuat! Silahkan tunggu konfirmasi dari admin.');

        } catch (\Exception $e) {
            DB::rollback();
            if (isset($buktiPath)) {
                Storage::disk('public')->delete($buktiPath);
            }
            return back()->with('error', 'Terjadi kesalahan saat membuat booking.');
        }
    }

    public function riwayatBooking()
    {
        $bookings = Booking::with(['detailBookings.produk'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('riwayatBooking', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::with(['detailBookings.produk'])
            ->where('id_booking', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('detailBooking', compact('booking'));
    }

    public function cancel($id)
    {
        $booking = Booking::where('id_booking', $id)
            ->where('user_id', Auth::id())
            ->where('status_booking', 'diproses')
            ->firstOrFail();

        try {
            DB::beginTransaction();

            // Update booking status
            $booking->update([
                'status_booking' => 'ditolak',
                'status_sewa' => 'belum_disewa'
            ]);

            DB::commit();

            return redirect()->route('riwayatBooking')
                ->with('success', 'Booking berhasil dibatalkan!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan saat membatalkan booking.');
        }
    }
}
