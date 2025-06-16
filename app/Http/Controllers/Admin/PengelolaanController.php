<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class PengelolaanController extends Controller
{
    public function index()
    {
        // Ambil semua produk dengan relasi kategori
        $catalogItems = Produk::with('kategori')->get()->map(function($produk) {
            return [
                'id' => $produk->id_produk,
                'nama' => $produk->nama_produk,
                'kategori' => $produk->kategori->nama_kategori,
                'gambar' => $produk->gambar,
                'harga' => $produk->harga_per_hari,
                'stok' => $produk->stock
            ];
        });

        // Ambil kategori untuk dropdown filter
        $kategori = Kategori::all();

        return view('admin.pengelolaan', [
            'catalogItems' => $catalogItems,
            'kategori' => $kategori
        ]);
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('pengelolaan.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori_produk,id_kategori',
            'deskripsi' => 'nullable|string',
            'harga_per_hari' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('produk', 'public');
            $validatedData['gambar'] = $gambarPath;
        }

        Produk::create($validatedData);

        return redirect()->route('pengelolaan.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();

        return view('pengelolaan.edit', compact('produk', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori_produk,id_kategori',
            'deskripsi' => 'nullable|string',
            'harga_per_hari' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }

            $gambarPath = $request->file('gambar')->store('produk', 'public');
            $validatedData['gambar'] = $gambarPath;
        }

        $produk->update($validatedData);

        return redirect()->route('pengelolaan.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus gambar terkait
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('pengelolaan.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}
