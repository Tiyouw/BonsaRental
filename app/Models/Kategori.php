<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Explicitly define the table name as it's not the default plural of the model name
    protected $table = 'kategori_produk';

    protected $primaryKey = 'id_kategori'; // Assuming this is your primary key

    protected $fillable = [
        'nama_kategori'
    ];

    /**
     * Get the products for the category.
     */
    public function produks()
    {
        return $this->hasMany(Produk::class, 'id_kategori');
    }
}
