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
                    <th class="px-4 py-2 text-left">Tanggal Booking</th>
                    <th class="px-4 py-2 text-left">Durasi</th>
                    <th class="px-4 py-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayat as $item)
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-4 py-2">{{ $item['produk'] }}</td>
                    <td class="px-4 py-2">{{ $item['tanggal'] }}</td>
                    <td class="px-4 py-2">{{ $item['durasi'] }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded text-sm
                            @if($item['status'] == 'Selesai') bg-green-100 text-green-700
                            @elseif($item['status'] == 'Dibatalkan') bg-red-100 text-red-700
                            @else bg-yellow-100 text-yellow-700 @endif">
                            {{ $item['status'] }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
