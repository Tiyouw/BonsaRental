@extends('layouts.app')

@section('title', 'Riwayat Penyewaan - BonsaRental')

@section('content')
<div class="flex">
    <div class="hidden md:block w-64 bg-dark min-h-screen fixed">
        <div class="flex flex-col">
            <a href="{{ route('dashboard', ['username' => $username]) }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <!-- Dashboard Icon -->
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('pengelolaan', ['username' => $username]) }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <!-- Pengelolaan Icon -->
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span>Pengelolaan</span>
            </a>
            <a href="{{ route('riwayatAdmin', ['username' => $username]) }}" class="flex items-center text-white bg-primary px-4 py-4">
                <!-- Riwayat Icon -->
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>Riwayat</span>
            </a>
            <a href="{{ route('profile', ['username' => $username]) }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <!-- Profile Icon -->
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <span>Profile</span>
            </a>
        </div>
    </div>

    <div class="w-full md:ml-64 px-4 py-8">
        <div class="container mx-auto">
            <div class="mb-8">
                <h1 class="text-2xl font-bold">Riwayat Penyewaan</h1>
                <p class="text-gray-600">Lihat histori penyewaan Anda sebelumnya</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100 text-sm text-gray-700">
                                <th class="px-4 py-2 text-left">Tanggal</th>
                                <th class="px-4 py-2 text-left">Barang</th>
                                <th class="px-4 py-2 text-left">Harga</th>
                                <th class="px-4 py-2 text-left">Penyewa</th>
                                <th class="px-4 py-2 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rentalHistory as $history)
                                <tr class="border-b hover:bg-gray-50 text-sm text-gray-800">
                                    <td class="px-4 py-3">{{ $history['tanggal'] }}</td>
                                    <td class="px-4 py-3">{{ $history['barang'] }}</td>
                                    <td class="px-4 py-3">Rp {{ number_format($history['harga'], 0, ',', '.') }}</td>
                                    <td class="px-4 py-3">{{ $history['penyewa'] }}</td>
                                    <td class="px-4 py-3">
                                        @php
                                            $statusColor = match($history['status']) {
                                                'Selesai' => 'bg-green-100 text-green-800',
                                                'Dibatalkan' => 'bg-red-100 text-red-800',
                                                'Diproses' => 'bg-yellow-100 text-yellow-800',
                                                default => 'bg-gray-100 text-gray-800',
                                            };
                                        @endphp
                                        <span class="{{ $statusColor }} text-xs font-semibold px-2.5 py-0.5 rounded">
                                            {{ $history['status'] }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada riwayat penyewaan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
