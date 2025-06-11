<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // <--- Pastikan ini di sini jika Anda menggunakannya

class User extends Authenticatable
{
    // --- Semua bagian ini harus berada di DALAM blok kelas User ---
    use HasApiTokens, HasFactory, Notifiable; // <--- HasApiTokens ada di sini

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone_number', // Termasuk ini jika Anda ingin menambahkannya
        'address',      // Termasuk ini jika Anda ingin menambahkannya
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Cek apakah pengguna adalah admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Jika Anda juga punya peran 'pelanggan' dan ingin metode serupa
     *
     * @return bool
     */
    public function isPelanggan()
    {
        return $this->role === 'pelanggan';
    }
    // --- Akhir dari semua bagian yang harus berada di DALAM blok kelas User ---
}
