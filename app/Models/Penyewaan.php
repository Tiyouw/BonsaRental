<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Produk;

class Penyewaan extends Model
{
    use HasFactory;

    protected $table = 'penyewaan';

    protected $fillable = [
        'user_id',
        'produk_id',
        'tanggal_mulai_sewa',
        'tanggal_selesai_sewa',
        'durasi_hari',
        'total_harga',
        'status',
        'bukti_transfer_path',
        'catatan_admin',
    ];

    protected $casts = [
    'tanggal_mulai_sewa' => 'date',
    'tanggal_selesai_sewa' => 'date',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
