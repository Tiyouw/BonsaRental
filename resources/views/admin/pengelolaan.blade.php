@extends('layouts.app')

@section('title', 'Pengelolaan Katalog')

@section('content')
<div class="flex">
     <x-admin_sidebar />

    <div class="w-full md:ml-64 px-4 py-8">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold">Pengelolaan Katalog</h1>
                    <p class="text-gray-600">Kelola item yang tersedia untuk disewa</p>
                </div>
                {{-- Tombol Tambah Item --}}
                <a href="{{ route('pengelolaan.create') }}" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-primary/80 transition mt-4 inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Item
                </a>
            </div>

            {{-- Filter dan Sorting Section --}}
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <form action="{{ route('pengelolaan.index') }}" method="GET" class="flex flex-col md:flex-row md:items-start md:justify-between space-y-4 md:space-y-0">

                    {{-- Group for Filter & Sorting dropdowns (left side) --}}
                    {{-- Tambahkan md:items-start di sini untuk menyelaraskan item-itemnya ke atas --}}
                    <div class="flex flex-col md:flex-row md:space-x-4 space-y-4 md:space-y-0 w-full md:w-2/3 md:items-start">
                        <div class="w-full md:w-1/2">
                            <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Filter Kategori:</label>
                            <select name="category_id" id="category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id_kategori }}" {{ $selectedCategoryId == $kategori->id_kategori ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-full md:w-1/2">
                            <label for="sort_by" class="block text-gray-700 text-sm font-bold mb-2">Urutkan Berdasarkan:</label>
                            <select name="sort_by" id="sort_by" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="latest" {{ $sortBy == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="oldest" {{ $sortBy == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                <option value="name_asc" {{ $sortBy == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                                <option value="name_desc" {{ $sortBy == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                                <option value="price_asc" {{ $sortBy == 'price_asc' ? 'selected' : '' }}>Harga (Terendah)</option>
                                <option value="price_desc" {{ $sortBy == 'price_desc' ? 'selected' : '' }}>Harga (Tertinggi)</option>
                                <option value="stock_asc" {{ $sortBy == 'stock_asc' ? 'selected' : '' }}>Stok (Terendah)</option>
                                <option value="stock_desc" {{ $sortBy == 'stock_desc' ? 'selected' : '' }}>Stok (Tertinggi)</option>
                            </select>
                        </div>
                    </div>

                    {{-- Group for Buttons (right side) --}}
                    <div class="w-full md:w-auto flex-shrink-0 flex space-x-2 mt-4 md:mt-0 md:justify-end">
                        <button type="submit" class="bg-primary hover:bg-primary/80 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition flex-grow md:flex-grow-0">
                            Terapkan Filter
                        </button>
                        <a href="{{ route('pengelolaan.index') }}" class="inline-block text-center bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition flex-grow md:flex-grow-0">
                            Reset Filter
                        </a>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Gambar</th>
                            <th class="px-4 py-2 text-left">Nama</th>
                            <th class="px-4 py-2 text-left">Kategori</th>
                            <th class="px-4 py-2 text-left">Harga/Hari</th>
                            <th class="px-4 py-2 text-left">Stok</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produks as $produkItem)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $produkItem->id_produk }}</td>
                            <td class="px-4 py-3">
                                @if($produkItem->gambar)
                                    <img src="{{ asset('storage/' . $produkItem->gambar) }}" alt="{{ $produkItem->nama_produk }}" class="w-14 h-14 object-cover rounded">
                                @else
                                    <img src="{{ asset('images/placeholder.png') }}" alt="No Image" class="w-14 h-14 object-cover rounded">
                                @endif
                            </td>
                            <td class="px-4 py-3">{{ $produkItem->nama_produk }}</td>
                            <td class="px-4 py-3">{{ $produkItem->kategori->nama_kategori ?? 'Tanpa Kategori' }}</td>
                            <td class="px-4 py-3">{{ number_format($produkItem->harga_per_hari, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">{{ $produkItem->stock }}</td>
                            <td class="px-4 py-3 flex items-center">
                                {{-- Tombol Edit --}}
                                <a href="{{ route('pengelolaan.edit', $produkItem->id_produk) }}" class="text-blue-600 hover:text-blue-800 mr-3">Edit</a>
                                {{-- Tombol Hapus --}}
                                <form action="{{ route('pengelolaan.destroy', $produkItem->id_produk) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-4 py-3 text-center text-gray-500">Tidak ada produk ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Menampilkan link pagination --}}
            <div class="mt-4">
                {{ $produks->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
