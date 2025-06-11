<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'nama', 'kategori', 'harga_per_hari', 'stok', 'deskripsi', 'gambar',
    ];

    public function penyewaan()
    {
        return $this->hasMany(Penyewaan::class);
    }
}
