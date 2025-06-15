<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
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
            ]
        ];

        foreach ($categories as $category) {
            Kategori::create($category);
        }
    }
}
