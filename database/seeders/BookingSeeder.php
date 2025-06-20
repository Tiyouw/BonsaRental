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
        // Mendefinisikan data booking menggunakan nilai status dan nama kolom yang konsisten
        $bookings = [
            [
                'user_id' => 2,
                'tanggal_booking' => Carbon::now()->subDays(5)->toDateString(), // Nama kolom konsisten
                'tanggal_kembali' => Carbon::now()->subDays(2)->toDateString(), // Nama kolom konsisten
                'total_harga' => 1500000,
                'status_booking' => Booking::STATUS_BOOKING_DISETUJUI, // Menggunakan konstanta
                'status_sewa' => Booking::STATUS_SEWA_KEMBALI,       // Menggunakan konstanta
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
                'tanggal_booking' => Carbon::now()->subDays(2)->toDateString(),
                'tanggal_kembali' => Carbon::now()->addDays(1)->toDateString(),
                'total_harga' => 800000,
                'status_booking' => Booking::STATUS_BOOKING_DISETUJUI,
                'status_sewa' => Booking::STATUS_SEWA_DISEWA,
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
                'user_id' => 3,
                'tanggal_booking' => Carbon::now()->addDays(1)->toDateString(),
                'tanggal_kembali' => Carbon::now()->addDays(3)->toDateString(),
                'total_harga' => 600000,
                'status_booking' => Booking::STATUS_BOOKING_DIPROSES,
                'status_sewa' => Booking::STATUS_SEWA_BELUM,
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
                'tanggal_booking' => Carbon::now()->subDays(1)->toDateString(),
                'tanggal_kembali' => Carbon::now()->addDays(2)->toDateString(),
                'total_harga' => 450000,
                'status_booking' => Booking::STATUS_BOOKING_DITOLAK,
                'status_sewa' => Booking::STATUS_SEWA_BELUM,
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
            ],
            // Contoh booking baru yang dibuat dengan 'diproses' dan 'belum_disewa'
            [
                'user_id' => 2,
                'tanggal_booking' => Carbon::now()->addDays(7)->toDateString(),
                'tanggal_kembali' => Carbon::now()->addDays(10)->toDateString(),
                'total_harga' => 750000,
                'status_booking' => Booking::STATUS_BOOKING_DIPROSES,
                'status_sewa' => Booking::STATUS_SEWA_BELUM,
                'bukti_pembayaran' => null, // Tidak ada bukti pembayaran untuk booking baru
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'details' => [
                    [
                        'id_produk' => 3, // Nikon D850
                        'jumlah' => 1,
                        'subtotal' => 750000
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
