@extends('layouts.app')

@section('title', 'Riwayat Penyewaan - BonsaRental')

@section('content')
     <x-admin_sidebar />

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
