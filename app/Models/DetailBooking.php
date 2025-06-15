<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBooking extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_detail_booking';

    protected $fillable = [
        'id_booking',
        'id_produk',
        'jumlah',
        'subtotal'
    ];

    // Relationship with Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'id_booking');
    }

    // Relationship with Product
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
