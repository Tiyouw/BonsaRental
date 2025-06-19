@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Tambah Produk</h2>

    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="nama_produk" class="block font-semibold">Nama Produk</label>
            <input type="text" name="nama_produk" class="w-full border px-4 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="id_kategori_produk" class="block font-semibold">Kategori</label>
            <select name="id_kategori_produk" class="w-full border px-4 py-2 rounded" required>
                @foreach($kategoriList as $kategori)
                    <option value="{{ $kategori->id_kategori_produk }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="block font-semibold">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border px-4 py-2 rounded"></textarea>
        </div>

        <div class="mb-4">
            <label for="harga_per_hari" class="block font-semibold">Harga per Hari</label>
            <input type="number" name="harga_per_hari" class="w-full border px-4 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="stok" class="block font-semibold">Stok</label>
            <input type="number" name="stok" class="w-full border px-4 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="gambar" class="block font-semibold">Gambar Produk</label>
            <input type="file" name="gambar" class="w-full border px-4 py-2 rounded" required>
        </div>

        <button type="submit" class="bg-primary text-white px-4 py-2 rounded">Simpan Produk</button>
    </form>
</div>
@endsection
