<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request; // Pastikan ini di-import
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProdukRequest;

class PengelolaanController extends Controller
{
    /**
     * Display a listing of the resource (daftar produk).
     * @param Request $request untuk filter dan sorting
     */
    public function index(Request $request) // Tambahkan Request $request
    {
        // Query dasar untuk produk dengan relasi kategori
        $query = Produk::with('kategori');

        // --- Filter Berdasarkan Kategori ---
        // Ambil 'category_id' dari request, jika ada
        $selectedCategoryId = $request->input('category_id');
        if ($selectedCategoryId && $selectedCategoryId != '') { // Pastikan bukan null atau string kosong
            $query->where('id_kategori', $selectedCategoryId);
        }

        // --- Pengurutan (Sorting) ---
        // Ambil 'sort_by' dari request, default 'latest'
        $sortBy = $request->input('sort_by', 'latest');

        switch ($sortBy) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('nama_produk', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('nama_produk', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('harga_per_hari', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('harga_per_hari', 'desc');
                break;
            case 'stock_asc':
                $query->orderBy('stock', 'asc');
                break;
            case 'stock_desc':
                $query->orderBy('stock', 'desc');
                break;
            case 'latest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Dapatkan hasil paginasi setelah filter dan sorting diterapkan
        $produks = $query->paginate(10);

        // Ambil semua kategori untuk dropdown filter
        $kategoris = Kategori::all();

        // Lewatkan objek paginator, daftar kategori, dan filter yang sedang aktif ke view
        return view('admin.pengelolaan', [
            'produks' => $produks,
            'kategoris' => $kategoris,
            'selectedCategoryId' => $selectedCategoryId, // Untuk mempertahankan pilihan filter
            'sortBy' => $sortBy // Untuk mempertahankan pilihan sorting
        ]);
    }

    /**
     * Show the form for creating a new resource (formulir tambah produk).
     */
    public function create()
    {
        try {
            $kategoris = Kategori::all();
        } catch (\Exception $e) {
            dd("Error fetching categories: " . $e->getMessage() . " (File: " . $e->getFile() . ", Line: " . $e->getLine() . ")");
        }

        return view('admin.pengelolaan.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage (menyimpan produk baru).
     */
    public function store(StoreProdukRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('products', 'public');
            $validatedData['gambar'] = $path;
        }

        Produk::create($validatedData);

        return redirect()->route('pengelolaan.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        // Implementasi untuk menampilkan detail satu produk
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategoris = Kategori::all();

        return view('admin.pengelolaan.edit', compact('produk', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_per_hari' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'id_kategori' => 'required|exists:kategori_produk,id_kategori'
        ]);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $gambarPath = $request->file('gambar')->store('products', 'public');
            $validatedData['gambar'] = $gambarPath;
        } else {
            unset($validatedData['gambar']);
        }

        $produk->update($validatedData);

        return redirect()->route('pengelolaan.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('pengelolaan.index')->with('success', 'Produk berhasil dihapus!');
    }
}
