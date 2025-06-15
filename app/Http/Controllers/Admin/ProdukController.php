<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller {
    public function index() {
        $produks = Produk::with('kategori')->paginate(10);
        return view('admin.pengelolaan', compact('produks'));
    }

    public function create() {
        $kategoris = Kategori::all();
        return view('admin.pengelolaan', compact('kategoris'));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'nama_produk' => 'required|max:255',
            'deskripsi' => 'nullable',
            'harga_per_hari' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048',
            'id_kategori' => 'required|exists:kategori_produk,id_kategori'
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('produk', 'public');
            $validatedData['gambar'] = $gambarPath;
        }

        Produk::create($validatedData);
        return redirect()->route('admin.pengelolaan')->with('success', 'Produk berhasil ditambahkan');
    }
}
