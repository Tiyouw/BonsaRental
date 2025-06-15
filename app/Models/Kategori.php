<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori_produk'; // Sesuaikan dengan nama tabel Anda
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori'
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_kategori', 'id_kategori');
    }
}
