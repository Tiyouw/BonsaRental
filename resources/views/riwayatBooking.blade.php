@extends('layouts.app')

@section('title', 'Riwayat Booking - BonsaRental')

@section('content')
<x-navbar />
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold text-primary mb-6">Riwayat Booking - {{ $username }}</h2>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full table-auto">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="px-4 py-2 text-left">Produk</th>
                    <th class="px-4 py-2 text-left">Tanggal Sewa</th>
                    <th class="px-4 py-2 text-left">Tanggal Kembali</th>
                    <th class="px-4 py-2 text-left">Durasi</th>
                    <th class="px-4 py-2 text-left">Total Harga</th>
                    <th class="px-4 py-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($riwayat as $item)
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-4 py-2">{{ $item->produk->nama }}</td>
                    <td class="px-4 py-2">{{ $item->tanggal_mulai_sewa->format('d M Y') }}</td>
                    <td class="px-4 py-2">{{ $item->tanggal_selesai_sewa->format('d M Y') }}</td>
                    <td class="px-4 py-2">{{ $item->durasi_hari }} Hari</td>
                    <td class="px-4 py-2">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    <td class="px-4 py-2">
                        @php
                            $statusColor = match($item->status) {
                                'selesai' => 'bg-green-100 text-green-700',
                                'dibatalkan' => 'bg-red-100 text-red-700',
                                'menunggu_pembayaran', 'menunggu_konfirmasi_admin', 'dikonfirmasi', 'sedang_disewa' => 'bg-yellow-100 text-yellow-700',
                                default => 'bg-gray-100 text-gray-700',
                            };
                        @endphp
                        <span class="{{ $statusColor }} px-2 py-1 rounded text-sm">
                            {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                        </span>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">Tidak ada riwayat booking.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
