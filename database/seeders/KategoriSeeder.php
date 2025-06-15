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
            ]
        ];

        foreach ($categories as $category) {
            Kategori::create($category);
        }
    }
}
