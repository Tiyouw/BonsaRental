@extends('layouts.app')

@section('title', 'Dashboard Pelanggan - BonsaRental')

@section('content')
<x-navbar />
@auth
    Selamat datang, {{ Auth::user()->name }}!
@else
    Silakan masuk.
@endauth
<div class="pt-24 pb-12 px-4 max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold text-primary text-center mb-6">Katalog Produk</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($catalogItems as $item)
            <div class="bg-white rounded-lg shadow-md p-4">
                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="w-full h-40 object-cover mb-4 rounded-md">

                <h2 class="text-xl font-semibold text-gray-800">{{ $item->nama }}</h2>
                <p class="text-gray-600">{{ $item->kategori }}</p>
                <p class="text-gray-700 text-sm mt-2">{{ $item->deskripsi }}</p>

                <div class="flex justify-between items-center mt-4">
                    <span class="text-primary font-bold">Rp {{ number_format($item->harga_per_hari, 0, ',', '.') }} / hari</span>
                    <span class="text-sm text-gray-500">Stok: {{ $item->stok }}</span>
                </div>

                @if ($item->stok > 0)
                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm">
                        Tersedia ({{ $item->stok }})
                    </span>
                @else
                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-sm">
                        Tidak Tersedia
                    </span>
                @endif

                <a href="{{ route('detailProduk', $item->id) }}" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-primary/80 transition-colors mt-4 block text-center">Lihat Detail</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
