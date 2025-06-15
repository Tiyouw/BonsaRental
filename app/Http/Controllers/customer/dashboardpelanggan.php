<?php

namespace App\Http\Controllers\customer;

use App\Models\Produk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardpelanggan extends Controller
{
    public function dashboardPelanggan()
    {
        $username = session('username', 'Pelanggan');


        $catalogItems = Produk::with('kategori')
            ->where('stok', '>', 0)
            ->get();

        return view('customer.dashboardPelanggan', compact('username', 'catalogItems'));
    }
}
