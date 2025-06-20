<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_booking';

    protected $fillable = [
        'user_id',
        'tanggal_booking', // Pastikan ini sesuai dengan migrasi
        'tanggal_kembali', // Pastikan ini sesuai dengan migrasi
        'total_harga',
        'status_booking',
        'status_sewa',
        'bukti_pembayaran'
    ];

    // Konstanta status untuk booking
    const STATUS_BOOKING_DIPROSES = 'diproses';
    const STATUS_BOOKING_DISETUJUI = 'disetujui';
    const STATUS_BOOKING_DITOLAK = 'ditolak';

    // Konstanta status untuk sewa
    const STATUS_SEWA_BELUM = 'belum_disewa'; // Status awal saat dibuat oleh pelanggan
    const STATUS_SEWA_DISEWA = 'disewa'; // Saat barang sedang disewa
    const STATUS_SEWA_KEMBALI = 'dikembalikan'; // Saat barang sudah dikembalikan

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan DetailBooking
    public function detailBookings()
    {
        return $this->hasMany(DetailBooking::class, 'id_booking');
    }

    // Metode helper untuk status booking - disederhanakan
    public function isDiproses()
    {
        return $this->status_booking === self::STATUS_BOOKING_DIPROSES;
    }

    public function isDisetujui()
    {
        return $this->status_booking === self::STATUS_BOOKING_DISETUJUI;
    }

    public function isDitolak()
    {
        return $this->status_booking === self::STATUS_BOOKING_DITOLAK;
    }

    // Metode helper untuk status sewa - disederhanakan
    public function isBelumDisewa()
    {
        return $this->status_sewa === self::STATUS_SEWA_BELUM;
    }

    public function isDisewa()
    {
        return $this->status_sewa === self::STATUS_SEWA_DISEWA;
    }

    public function isDikembalikan()
    {
        return $this->status_sewa === self::STATUS_SEWA_KEMBALI;
    }

    // Mendapatkan label status booking dengan warna untuk tampilan
    public function getStatusBookingLabel()
    {
        return match($this->status_booking) {
            self::STATUS_BOOKING_DIPROSES => ['text' => 'Diproses', 'color' => 'yellow'],
            self::STATUS_BOOKING_DISETUJUI => ['text' => 'Disetujui', 'color' => 'green'],
            self::STATUS_BOOKING_DITOLAK => ['text' => 'Ditolak', 'color' => 'red'],
            default => ['text' => 'Unknown Booking Status', 'color' => 'gray'],
        };
    }

    /**
     * Mendapatkan label status sewa dengan warna untuk tampilan - disederhanakan.
     *
     * @return array Array asosiatif yang berisi 'text' dan 'color'.
     */
    public function getStatusSewaLabel()
    {
        return match($this->status_sewa) {
            self::STATUS_SEWA_BELUM => ['text' => 'Belum Disewa', 'color' => 'gray'],
            self::STATUS_SEWA_DISEWA => ['text' => 'Sedang Disewa', 'color' => 'blue'],
            self::STATUS_SEWA_KEMBALI => ['text' => 'Dikembalikan', 'color' => 'green'],
            default => ['text' => 'Unknown Rental Status', 'color' => 'gray'],
        };
    }
}
