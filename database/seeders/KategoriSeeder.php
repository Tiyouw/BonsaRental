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
                'nama_kategori' => 'Kamera',
                'deskripsi' => 'Berbagai jenis kamera untuk disewa'
            ],
            [
                'nama_kategori' => 'Lensa',
                'deskripsi' => 'Lensa kamera dengan berbagai focal length'
            ]
        ];

        foreach ($categories as $category) {
            Kategori::create($category);
        }
    }
}
