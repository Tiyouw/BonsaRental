<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('produk')->insert([
            [
                'nama_produk' => 'Canon 60D',
                'deskripsi' => 'Kamera DSLR profesional dengan resolusi 18MP',
                'harga_per_hari' => 150000,
                'stock' => 5,
                'gambar' => 'images/canon60d.jpg',
                'id_kategori' => 1, // Sesuaikan dengan ID kategori kamera
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_produk' => 'Canon 18-55mm Lens',
                'deskripsi' => 'Lensa kit standar untuk kamera Canon DSLR',
                'harga_per_hari' => 50000,
                'stock' => 8,
                'gambar' => 'images/canon_lens.jpg',
                'id_kategori' => 2, // Sesuaikan dengan ID kategori lensa
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_produk' => 'Tripod Professional',
                'deskripsi' => 'Tripod kokoh untuk fotografi profesional',
                'harga_per_hari' => 75000,
                'stock' => 10,
                'gambar' => 'images/tripod.jpg',
                'id_kategori' => 3, // Sesuaikan dengan ID kategori aksesoris
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
