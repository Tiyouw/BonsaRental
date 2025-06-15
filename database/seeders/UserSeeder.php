<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username'      => 'admin',
            'email'         => 'admin@example.com',
            'password'      => Hash::make('password123'),
            'nama_lengkap'  => 'Admin BonsaRental',
            'no_hp'         => '081234567890',
            'alamat'        => 'Jl. Utama No.1, Jember',
        ]);

        User::create([
            'username'      => 'pelanggan1',
            'email'         => 'pelanggan1@example.com',
            'password'      => Hash::make('password123'),
            'nama_lengkap'  => 'Pelanggan Pertama',
            'no_hp'         => '082345678901',
            'alamat'        => 'Jl. Mawar No.2, Jember',
        ]);
    }
}
