<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get existing categories to link products
        // Retrieve categories by their names to ensure correct linking
        $kameraCategory = Kategori::where('nama_kategori', 'Kamera')->first();
        $lensaCategory = Kategori::where('nama_kategori', 'Lensa')->first();
        $tripodCategory = Kategori::where('nama_kategori', 'Tripod')->first();
        $filterCategory = Kategori::where('nama_kategori', 'Filter')->first();
        $flashCategory = Kategori::where('nama_kategori', 'Flash')->first();


        // Define products with specific image names based on category
        $produksData = [
            [
                'nama_produk' => 'Canon EOS R5',
                'deskripsi' => 'Kamera mirrorless full-frame profesional dengan resolusi tinggi.',
                'harga_per_hari' => 500000,
                'stock' => 5,
                'id_kategori' => $kameraCategory ? $kameraCategory->id_kategori : null,
                'gambar' => 'products/camera.jpg', // Assign specific image for camera
            ],
            [
                'nama_produk' => 'Sony A7 III',
                'deskripsi' => 'Kamera mirrorless serbaguna dengan performa autofokus yang sangat baik.',
                'harga_per_hari' => 400000,
                'stock' => 7,
                'id_kategori' => $kameraCategory ? $kameraCategory->id_kategori : null,
                'gambar' => 'products/camera.jpg', // Assign specific image for camera
            ],
            [
                'nama_produk' => 'Nikon D850',
                'deskripsi' => 'DSLR full-frame beresolusi tinggi untuk fotografer profesional.',
                'harga_per_hari' => 350000,
                'stock' => 4,
                'id_kategori' => $kameraCategory ? $kameraCategory->id_kategori : null,
                'gambar' => 'products/camera.jpg', // Assign specific image for camera
            ],
            [
                'nama_produk' => 'Canon RF 24-70mm f/2.8L IS USM',
                'deskripsi' => 'Lensa zoom standar serbaguna untuk sistem Canon RF.',
                'harga_per_hari' => 300000,
                'stock' => 3,
                'id_kategori' => $lensaCategory ? $lensaCategory->id_kategori : null,
                'gambar' => 'products/lens.jpg', // Assign specific image for canon lens
            ],
            [
                'nama_produk' => 'Sony FE 85mm f/1.4 GM',
                'deskripsi' => 'Lensa portrait prima dengan bokeh indah dan ketajaman luar biasa.',
                'harga_per_hari' => 250000,
                'stock' => 5,
                'id_kategori' => $lensaCategory ? $lensaCategory->id_kategori : null,
                'gambar' => 'products/lens.jpg', // Assign specific image for canon lens (assuming common lens image)
            ],
            [
                'nama_produk' => 'Tripod Manfrotto Befree Advanced',
                'deskripsi' => 'Tripod travel yang ringkas dan stabil.',
                'harga_per_hari' => 50000,
                'stock' => 10,
                'id_kategori' => $tripodCategory ? $tripodCategory->id_kategori : null,
                'gambar' => 'products/tripod.jpg', // Assign specific image for tripod
            ],
            [
                'nama_produk' => 'Filter ND Variabel Hoya PRO-ND 67mm',
                'deskripsi' => 'Filter kepadatan netral variabel untuk kontrol eksposur.',
                'harga_per_hari' => 30000,
                'stock' => 8,
                'id_kategori' => $filterCategory ? $filterCategory->id_kategori : null,
                'gambar' => 'products/filter.jpg', // Assign specific image for filter
            ],
            [
                'nama_produk' => 'Godox V860II-C Flash Speedlite',
                'deskripsi' => 'Flash TTL yang kompatibel dengan kamera Canon.',
                'harga_per_hari' => 75000,
                'stock' => 6,
                'id_kategori' => $flashCategory ? $flashCategory->id_kategori : null,
                'gambar' => 'products/flash.jpg', // Assign specific image for flash
            ],
        ];

        foreach ($produksData as $data) {
            Produk::create($data);
        }
    }
}
