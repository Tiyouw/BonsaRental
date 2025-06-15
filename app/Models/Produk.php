<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga_per_hari',
        'stock',
        'gambar',
        'id_kategori'
    ];

    // Relationship with category
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    // Relationship with booking details
    public function detailBookings()
    {
        return $this->hasMany(DetailBooking::class, 'id_produk');
    }

    // Check if product is available
    public function isAvailable()
    {
        return $this->stock > 0;
    }

    // Get formatted price
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->harga_per_hari, 0, ',', '.');
    }

    // Get image URL
    public function getImageUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/' . $this->gambar);
        }
        return asset('images/default-product.jpg');
    }

    // Calculate total price for rental period
    public function calculateTotalPrice($quantity, $startDate, $endDate)
    {
        $days = \Carbon\Carbon::parse($startDate)
            ->diffInDays(\Carbon\Carbon::parse($endDate));
        return $this->harga_per_hari * $quantity * $days;
    }
}
