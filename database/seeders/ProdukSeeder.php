<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // Kamera (id_kategori: 1)
            [
                'nama_produk' => 'Canon EOS R5',
                'deskripsi' => 'Kamera mirrorless full-frame 45MP dengan kemampuan video 8K. Cocok untuk fotografi profesional dan videografi.',
                'harga_per_hari' => 500000,
                'stock' => 3,
                'gambar' => 'products/canon-r5.jpg',
                'id_kategori' => 1
            ],
            [
                'nama_produk' => 'Sony A7 III',
                'deskripsi' => 'Kamera mirrorless full-frame 24MP dengan performa AF yang sangat baik. Ideal untuk berbagai jenis fotografi.',
                'harga_per_hari' => 400000,
                'stock' => 2,
                'gambar' => 'products/sony-a7iii.jpg',
                'id_kategori' => 1
            ],
            [
                'nama_produk' => 'Nikon Z6',
                'deskripsi' => 'Kamera mirrorless full-frame 24MP dengan stabilisasi dalam body. Sempurna untuk foto dan video.',
                'harga_per_hari' => 450000,
                'stock' => 2,
                'gambar' => 'products/nikon-z6.jpg',
                'id_kategori' => 1
            ],

            // Lensa (id_kategori: 2)
            [
                'nama_produk' => 'Canon RF 24-70mm f/2.8L IS USM',
                'deskripsi' => 'Lensa zoom standar profesional dengan aperture f/2.8 konstan. Ideal untuk berbagai situasi pemotretan.',
                'harga_per_hari' => 200000,
                'stock' => 2,
                'gambar' => 'products/canon-24-70.jpg',
                'id_kategori' => 2
            ],
            [
                'nama_produk' => 'Sony FE 85mm f/1.8',
                'deskripsi' => 'Lensa portrait premium dengan aperture besar. Menghasilkan bokeh yang indah.',
                'harga_per_hari' => 150000,
                'stock' => 3,
                'gambar' => 'products/sony-85mm.jpg',
                'id_kategori' => 2
            ],
            [
                'nama_produk' => 'Canon RF 50mm f/1.2L USM',
                'deskripsi' => 'Lensa prime dengan aperture super besar. Sempurna untuk low-light dan portrait.',
                'harga_per_hari' => 250000,
                'stock' => 2,
                'gambar' => 'products/canon-50mm.jpg',
                'id_kategori' => 2
            ],
            [
                'nama_produk' => 'Nikon Z 14-30mm f/4 S',
                'deskripsi' => 'Lensa ultra wide-angle yang ringkas. Ideal untuk landscape dan arsitektur.',
                'harga_per_hari' => 200000,
                'stock' => 2,
                'gambar' => 'products/nikon-14-30.jpg',
                'id_kategori' => 2
            ]
        ];

        foreach ($products as $product) {
            Produk::create($product);
        }
    }
}
