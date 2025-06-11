@extends('layouts.app')

@section('title', 'Dashboard - BonsaRental')

@section('content')
<div class="flex">
    <div class="hidden md:block w-64 bg-dark min-h-screen fixed">
        <div class="flex flex-col">
            <a href="{{ route('dashboard', ['username' => $username]) }}" class="flex items-center text-white bg-primary px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('pengelolaan', ['username' => $username]) }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m7 0V5a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h-2"></path>
                </svg>
                <span>Pengelolaan</span>
            </a>
            <a href="{{ route('riwayatAdmin', ['username' => $username]) }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                <span>Riwayat Penyewaan</span>
            </a>
            <a href="{{ route('profile', ['username' => $username]) }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span>Profil</span>
            </a>
            <a href="{{ route('logout') }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span>Logout</span>
            </a>
        </div>
    </div>
    <div class="flex-grow md:ml-64 pt-16 p-4">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Selamat datang, {{ $username }}!</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Jumlah Produk Tersedia</h2>
                <p class="text-3xl font-bold text-primary">{{ $totalProduk }}</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Penyewaan Bulan Ini</h2>
                <p class="text-3xl font-bold text-primary">{{ $totalPenyewaanBulanIni }}</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Riwayat Penyewaan Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Tanggal</th>
                            <th class="px-4 py-2 text-left">Barang</th>
                            <th class="px-4 py-2 text-left">Harga</th>
                            <th class="px-4 py-2 text-left">Penyewa</th>
                            <th class="px-4 py-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rentalHistory as $history)
                        <tr class="border-b hover:bg-gray-50">
                            {{-- Mengakses kolom tanggal_mulai_sewa dan memformatnya --}}
                            <td class="px-4 py-3">{{ $history->tanggal_mulai_sewa->format('d M Y') }}</td>
                            {{-- Mengakses nama produk melalui relasi 'produk' --}}
                            <td class="px-4 py-3">{{ $history->produk->nama }}</td>
                            {{-- Mengakses total_harga dan memformatnya --}}
                            <td class="px-4 py-3">Rp {{ number_format($history->total_harga, 0, ',', '.') }}</td>
                            {{-- Mengakses nama user melalui relasi 'user' --}}
                            <td class="px-4 py-3">{{ $history->user->name }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $statusColor = match($history->status) {
                                        'Selesai' => 'bg-green-100 text-green-800',
                                        'Dibatalkan' => 'bg-red-100 text-red-800',
                                        'Diproses' => 'bg-blue-100 text-blue-800', // Contoh status baru
                                        'menunggu_pembayaran' => 'bg-gray-100 text-gray-800',
                                        'menunggu_konfirmasi_admin' => 'bg-yellow-100 text-yellow-800',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <span class="{{ $statusColor }} text-xs font-semibold px-2.5 py-0.5 rounded">
                                    {{ ucwords(str_replace('_', ' ', $history->status)) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada riwayat penyewaan terbaru.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-right mt-4">
                <a href="{{ route ('riwayatAdmin', ['username' => $username]) }}" class="text-primary hover:underline">Lihat Selengkapnya</a>
            </div>
        </div>
    </div>
</div>
@endsection
