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

    /**
     * Display a listing of the bookings for admin.
     * Fetches all bookings with user and product details, ordered by creation date.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all bookings including related user and product data
        $bookings = Booking::with(['user', 'detailBookings.produk'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Return the admin bookings index view with the fetched bookings.
        // The original view was 'admin/riwayatAdmin', which is incorrect for this route.
        // It should point to 'admin.bookings.index' as per the file structure and user's request.
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Display the specified booking.
     *
     * @param  int  $id The ID of the booking to show.
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Find the booking by its ID and eager load related user and product details.
        $booking = Booking::with(['user', 'detailBookings.produk'])
            ->findOrFail($id); // Use findOrFail to automatically handle not found cases

        // Return the admin booking detail view with the fetched booking.
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Update the booking status.
     *
     * @param  \Illuminate\Http\Request  $request The request containing the new status.
     * @param  int  $id The ID of the booking to update.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatusBooking(Request $request, $id)
    {
        // Validate the incoming request for status_booking
        $request->validate([
            'status_booking' => 'required|in:diproses,disetujui,ditolak'
        ]);

        // Find the booking by its ID.
        $booking = Booking::findOrFail($id);

        // If rejecting a booking that was previously approved, return products to stock.
        // This ensures inventory is correctly managed.
        if ($request->status_booking == Booking::STATUS_BOOKING_DITOLAK && $booking->status_booking == Booking::STATUS_BOOKING_DISETUJUI) {
            foreach ($booking->detailBookings as $detail) {
                $detail->produk->increment('stock', $detail->jumlah);
            }
        }

        // If approving a booking that was previously in process, check and decrease product stock.
        // This prevents over-booking if stock is insufficient.
        if ($request->status_booking == Booking::STATUS_BOOKING_DISETUJUI && $booking->status_booking == Booking::STATUS_BOOKING_DIPROSES) {
            foreach ($booking->detailBookings as $detail) {
                if ($detail->produk->stock < $detail->jumlah) {
                    // Redirect back with an error if stock is insufficient.
                    return back()->with('error', 'Stok produk ' . $detail->produk->nama_produk . ' tidak mencukupi.');
                }
                // Decrease stock when booking is approved.
                $detail->produk->decrement('stock', $detail->jumlah);
            }
        }

        // Update the booking status and save changes.
        $booking->status_booking = $request->status_booking;
        $booking->save();

        // Redirect to the booking detail page with a success message.
        return redirect()->route('admin.bookings.show', $booking->id_booking)
            ->with('success', 'Status booking berhasil diperbarui.');
    }

    /**
     * Update the rental status.
     *
     * @param  \Illuminate\Http\Request  $request The request containing the new status.
     * @param  int  $id The ID of the booking to update.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatusSewa(Request $request, $id)
    {
        // Validate the incoming request for status_sewa.
        $request->validate([
            'status_sewa' => 'required|in:belum_disewa,disewa,dikembalikan'
        ]);

        // Find the booking by its ID.
        $booking = Booking::findOrFail($id);

        // Only allow status update if booking is approved to maintain business logic.
        if ($booking->status_booking !== Booking::STATUS_BOOKING_DISETUJUI) {
            return back()->with('error', 'Status sewa hanya dapat diubah untuk booking yang disetujui.');
        }

        // If item is being returned, return products to stock.
        // This ensures that products become available again after rental completion.
        if ($request->status_sewa == Booking::STATUS_SEWA_KEMBALI && $booking->status_sewa == Booking::STATUS_SEWA_DISEWA) {
            foreach ($booking->detailBookings as $detail) {
                $detail->produk->increment('stock', $detail->jumlah);
            }
        }

        // Update the rental status and save changes.
        $booking->status_sewa = $request->status_sewa;
        $booking->save();

        // Redirect to the booking detail page with a success message.
        return redirect()->route('admin.bookings.show', $booking->id_booking)
            ->with('success', 'Status sewa berhasil diperbarui.');
    }

    /**
     * Remove the specified booking from storage.
     *
     * @param  int  $id The ID of the booking to delete.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Find the booking by its ID.
        $booking = Booking::findOrFail($id);

        // Return products to stock if booking was approved and items weren't returned.
        // This is important for correct inventory management upon deletion.
        if ($booking->status_booking == Booking::STATUS_BOOKING_DISETUJUI && $booking->status_sewa != Booking::STATUS_SEWA_KEMBALI) {
            foreach ($booking->detailBookings as $detail) {
                $detail->produk->increment('stock', $detail->jumlah);
            }
        }

        // Delete the booking record.
        $booking->delete();

        // Redirect to the admin bookings index page with a success message.
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking berhasil dihapus.');
    }
}
