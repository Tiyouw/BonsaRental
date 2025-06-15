<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\DetailBooking;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run()
    {
        // Create sample bookings
        $bookings = [
            [
                'user_id' => 2, // Assuming user ID 2 is a regular customer
                'tanggal_booking' => Carbon::now()->subDays(5),
                'tanggal_kembali' => Carbon::now()->subDays(2),
                'total_harga' => 1500000,
                'status_booking' => 'disetujui',
                'status_sewa' => 'dikembalikan',
                'bukti_pembayaran' => 'bukti_pembayaran/sample1.jpg',
                'created_at' => Carbon::now()->subDays(6),
                'updated_at' => Carbon::now()->subDays(5),
                'details' => [
                    [
                        'id_produk' => 1, // Canon EOS R5
                        'jumlah' => 1,
                        'subtotal' => 1500000
                    ]
                ]
            ],
            [
                'user_id' => 2,
                'tanggal_booking' => Carbon::now()->subDays(2),
                'tanggal_kembali' => Carbon::now()->addDays(1),
                'total_harga' => 800000,
                'status_booking' => 'disetujui',
                'status_sewa' => 'disewa',
                'bukti_pembayaran' => 'bukti_pembayaran/sample2.jpg',
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(2),
                'details' => [
                    [
                        'id_produk' => 2, // Sony A7 III
                        'jumlah' => 1,
                        'subtotal' => 800000
                    ]
                ]
            ],
            [
                'user_id' => 3, // Another customer
                'tanggal_booking' => Carbon::now()->addDays(1),
                'tanggal_kembali' => Carbon::now()->addDays(3),
                'total_harga' => 600000,
                'status_booking' => 'diproses',
                'status_sewa' => 'belum_disewa',
                'bukti_pembayaran' => 'bukti_pembayaran/sample3.jpg',
                'created_at' => Carbon::now()->subHours(2),
                'updated_at' => Carbon::now()->subHours(2),
                'details' => [
                    [
                        'id_produk' => 4, // Canon RF 24-70mm
                        'jumlah' => 1,
                        'subtotal' => 600000
                    ]
                ]
            ],
            [
                'user_id' => 3,
                'tanggal_booking' => Carbon::now()->subDays(1),
                'tanggal_kembali' => Carbon::now()->addDays(2),
                'total_harga' => 450000,
                'status_booking' => 'ditolak',
                'status_sewa' => 'belum_disewa',
                'bukti_pembayaran' => 'bukti_pembayaran/sample4.jpg',
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(1),
                'details' => [
                    [
                        'id_produk' => 5, // Sony FE 85mm
                        'jumlah' => 1,
                        'subtotal' => 450000
                    ]
                ]
            ]
        ];

        foreach ($bookings as $bookingData) {
            $details = $bookingData['details'];
            unset($bookingData['details']);
            
            $booking = Booking::create($bookingData);

            foreach ($details as $detail) {
                DetailBooking::create([
                    'id_booking' => $booking->id_booking,
                    'id_produk' => $detail['id_produk'],
                    'jumlah' => $detail['jumlah'],
                    'subtotal' => $detail['subtotal']
                ]);
            }
        }
    }
}
