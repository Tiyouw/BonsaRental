@extends('layouts.app')

@section('title', 'Tambah Produk Baru')

@section('content')
<div class="container mx-auto px-4 py-8"> {{-- Removed redundant layout wrappers --}}
    <div class="mb-6">
        <a href="{{ route('pengelolaan.index') }}" class="inline-flex items-center text-gray-700 hover:text-gray-900">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M15 18l-6-6 6-6"></path>
            </svg>
            Kembali ke Pengelolaan Katalog
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Tambah Produk Baru</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pengelolaan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="nama_produk" class="block text-gray-700 text-sm font-bold mb-2">Nama Produk:</label>
                <input type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('deskripsi') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="harga_per_hari" class="block text-gray-700 text-sm font-bold mb-2">Harga per Hari (Rp):</label>
                <input type="number" name="harga_per_hari" id="harga_per_hari" value="{{ old('harga_per_hari') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required min="0">
            </div>

            <div class="mb-4">
                <label for="stock" class="block text-gray-700 text-sm font-bold mb-2">Stok:</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required min="0">
            </div>

            <div class="mb-4">
                <label for="id_kategori" class="block text-gray-700 text-sm font-bold mb-2">Kategori:</label>
                <select name="id_kategori" id="id_kategori"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">Gambar Produk:</label>
                <input type="file" name="gambar" id="gambar"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, JPEG. Maks: 2MB.</p>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-primary hover:bg-primary/80 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Tambah Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
