@extends('layouts.app')

@section('title', 'Tambah Produk Baru')

@section('content')
{{-- Mulai dari sini, tambahkan struktur sidebar --}}
<div class="flex">
     <x-admin_sidebar />

    {{-- Konten utama form Anda sekarang ada di sini, di samping sidebar --}}
    <div class="w-full md:ml-64 px-4 py-8">
        <div class="container mx-auto">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Produk Baru</h1>

                <form action="{{ route('pengelolaan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Nama Produk --}}
                    <div class="mb-4">
                        <label for="nama_produk" class="block text-gray-700 text-sm font-bold mb-2">Nama Produk:</label>
                        <input type="text" name="nama_produk" id="nama_produk" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_produk') border-red-500 @enderror" value="{{ old('nama_produk') }}" required>
                        @error('nama_produk')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-4">
                        <label for="id_kategori" class="block text-gray-700 text-sm font-bold mb-2">Kategori:</label>
                        <select name="id_kategori" id="id_kategori" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('id_kategori') border-red-500 @enderror" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
                        <textarea name="deskripsi" id="deskripsi" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('deskripsi') border-red-500 @enderror" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Harga Sewa --}}
                    <div class="mb-4">
                        <label for="harga_per_hari" class="block text-gray-700 text-sm font-bold mb-2">Harga Sewa (per hari):</label>
                        <input type="number" name="harga_per_hari" id="harga_per_hari" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('harga_per_hari') border-red-500 @enderror" value="{{ old('harga_per_hari') }}" required min="0">
                        @error('harga_per_hari')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Stok --}}
                    <div class="mb-4">
                        <label for="stock" class="block text-gray-700 text-sm font-bold mb-2">Stok:</label>
                        <input type="number" name="stock" id="stock" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('stock') border-red-500 @enderror" value="{{ old('stock') }}" required min="0">
                        @error('stock')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Gambar Produk --}}
                    <div class="mb-6">
                        <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">Gambar Produk:</label>
                        <input type="file" name="gambar" id="gambar" accept="image/*" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('gambar') border-red-500 @enderror">
                        @error('gambar')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-600 text-xs mt-1">Format: JPG, PNG, JPEG. Maks: 2MB.</p>
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-primary hover:bg-primary/80 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition">
                            Simpan Produk
                        </button>
                        <a href="{{ route('pengelolaan.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
