<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class kategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    DB::table('kategori_produk')->insert([
        ['nama_kategori' => 'Kamera'],
        ['nama_kategori' => 'Lensa'],
        ['nama_kategori' => 'Tripod'],
        ['nama_kategori' => 'Aksesoris']
    ]);
    }
}
