@extends('layouts.app')

@section('title', 'Dashboard - BonsaRental')

@section('content')
{{-- The main content for the admin dashboard. The sidebar is now rendered in layouts/app.blade.php --}}
<div class="container mx-auto px-4 py-8"> {{-- Removed redundant layout wrappers --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold">Dashboard</h1>
            <p class="text-gray-600">Aktivitas dalam BonsaRental</p>
        </div>
        <div class="flex items-center mt-4 md:mt-0">
            <button class="mr-4 p-2 border rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path></svg>
            </button>
            @php
                $initials = '';
                if (isset($user) && $user->nama_lengkap) {
                    $nameParts = explode(' ', $user->nama_lengkap);
                    $initials .= strtoupper(substr($nameParts[0], 0, 1));
                    if (count($nameParts) > 1) {
                        $initials .= strtoupper(substr($nameParts[count($nameParts) - 1], 0, 1));
                    }
                } else {
                    $initials = 'AD';
                }
            @endphp
            <a href="{{ route('admin.profile') }}">
                @if(isset($user) && $user->gambar)
                    <img src="{{ asset('storage/' . $user->gambar) }}" alt="Profile" class="w-10 h-10 rounded-full object-cover">
                @else
                    <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white text-sm font-bold">
                        {{ $initials }}
                    </div>
                @endif
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-primary rounded-lg overflow-hidden text-white">
            <div class="p-6 flex flex-col md:flex-row justify-between h-full">
                <div class="mb-4 md:mb-0 md:w-2/3">
                    <h3 class="text-xl font-semibold mb-3">Kelola Perlengkapan Fotografi</h3>
                    <p class="mb-4">Jangan lupa cek barang/stok di lemari!</p>
                    <a href="{{route('pengelolaan.index')}}" class="inline-block bg-white text-primary hover:bg-light px-4 py-2 rounded-md">Lihat Sekarang</a>
                </div>
                <div class="md:w-1/3 flex justify-center md:justify-end">
                    <img src="/images/lens.png" alt="Camera Lens" class="h-32 object-contain">
                </div>
            </div>
        </div>
        <div class="bg-accent rounded-lg overflow-hidden text-gray-800">
            <div class="p-6 flex flex-col md:flex-row justify-between h-full">
                <div class="mb-4 md:mb-0 md:w-2/3">
                    <h3 class="text-xl font-semibold mb-3">Pelanggan BonsaRental</h3>
                    <p class="mb-4">Lihat Data pelanggan Bonsa Rental</p>
                    <a href="{{ route('admin.customers.index') }}" class="inline-block bg-gray-800 text-white hover:bg-gray-700 px-4 py-2 rounded-md">Lihat sekarang!</a>
                </div>
                <div class="md:w-1/3 flex justify-center md:justify-end">
                    <img src="/images/lens.png" alt="Camera Lens" class="h-32 object-contain">
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 mt-8">
        <h3 class="text-xl font-semibold mb-6">Riwayat Penyewaan</h3>
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left">Tanggal</th>
                        <th class="px-4 py-2 text-left">Barang</th>
                        <th class="px-4 py-2 text-left">Harga</th>
                        <th class="px-4 py-2 text-left">Penyewa</th>
                        <th class="px-4 py-2 text-left">Status Booking</th>
                        <th class="px-4 py-2 text-left">Status Sewa</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($rentalHistory) && count($rentalHistory) > 0)
                        @foreach($rentalHistory as $history)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $history['tanggal'] }}</td>
                            <td class="px-4 py-3">{{ $history['barang'] }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($history['harga'], 0, ',', '.') }}</td>
                            <td class="px-4 py-3">{{ $history['penyewa'] }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                    bg-{{ $history['status_booking']['color'] }}-100 text-{{ $history['status_booking']['color'] }}-800">
                                    {{ $history['status_booking']['text'] }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                    bg-{{ $history['status_sewa']['color'] }}-100 text-{{ $history['status_sewa']['color'] }}-800">
                                    {{ $history['status_sewa']['text'] }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="px-4 py-3 text-center text-gray-500">Tidak ada riwayat penyewaan untuk ditampilkan.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="text-right mt-4">
            <a href="{{ route('admin.bookings.index') }}" class="text-primary hover:underline">Lihat Selengkapnya</a>
        </div>
    </div>
</div>
@endsection
