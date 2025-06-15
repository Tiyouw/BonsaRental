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
        'tanggal_booking',
        'tanggal_kembali',
        'total_harga',
        'status_booking',
        'status_sewa',
        'bukti_pembayaran'
    ];

    // Status constants for booking
    const STATUS_BOOKING_DIPROSES = 'diproses';
    const STATUS_BOOKING_DISETUJUI = 'disetujui';
    const STATUS_BOOKING_DITOLAK = 'ditolak';

    // Status constants for rental
    const STATUS_SEWA_BELUM = 'belum_disewa';
    const STATUS_SEWA_DISEWA = 'disewa';
    const STATUS_SEWA_KEMBALI = 'dikembalikan';

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with DetailBooking
    public function detailBookings()
    {
        return $this->hasMany(DetailBooking::class, 'id_booking');
    }

    // Helper methods for booking status
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

    // Helper methods for rental status
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

    // Get status label with color for display
    public function getStatusBookingLabel()
    {
        return match($this->status_booking) {
            self::STATUS_BOOKING_DIPROSES => ['text' => 'Diproses', 'color' => 'yellow'],
            self::STATUS_BOOKING_DISETUJUI => ['text' => 'Disetujui', 'color' => 'green'],
            self::STATUS_BOOKING_DITOLAK => ['text' => 'Ditolak', 'color' => 'red'],
            default => ['text' => 'Unknown', 'color' => 'gray'],
        };
    }

    public function getStatusSewaLabel()
    {
        return match($this->status_sewa) {
            self::STATUS_SEWA_BELUM => ['text' => 'Belum Disewa', 'color' => 'gray'],
            self::STATUS_SEWA_DISEWA => ['text' => 'Sedang Disewa', 'color' => 'blue'],
            self::STATUS_SEWA_KEMBALI => ['text' => 'Dikembalikan', 'color' => 'green'],
            default => ['text' => 'Unknown', 'color' => 'gray'],
        };
    }
}
