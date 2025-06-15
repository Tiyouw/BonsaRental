<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $categories = Kategori::all();
        
        // Get selected category or default to first category
        $selectedCategoryId = $request->query('category', $categories->first()->id_kategori ?? null);
        
        $category = null;
        $products = collect();

        if ($selectedCategoryId) {
            $category = Kategori::find($selectedCategoryId);
            $products = Produk::where('id_kategori', $selectedCategoryId)
                ->where('stock', '>', 0)
                ->orderBy('nama_produk')
                ->get();
        }

        return view('katalog', compact('categories', 'category', 'products'));
    }
}
