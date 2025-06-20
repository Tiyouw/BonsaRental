<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define categories, ensure 'Filter' and 'Flash' are included
        $categories = [
            [
                'nama_kategori' => 'Kamera'
            ],
            [
                'nama_kategori' => 'Lensa'
            ],
            [
                'nama_kategori' => 'Tripod'
            ],
            [
                'nama_kategori' => 'Aksesoris'
            ],
            [
                'nama_kategori' => 'Filter' // Added missing category
            ],
            [
                'nama_kategori' => 'Flash' // Added missing category
            ],
        ];

        foreach ($categories as $category) {
            // Use updateOrCreate to avoid duplicates if running seeder multiple times without refresh
            Kategori::updateOrCreate(
                ['nama_kategori' => $category['nama_kategori']],
                $category
            );
        }
    }
}
