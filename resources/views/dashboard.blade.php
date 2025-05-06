<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard - BonsaRental')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    <div class="hidden md:block w-64 bg-dark min-h-screen fixed">
        <div class="flex flex-col">
            <a href="{{ route('dashboard') }}" class="flex items-center text-white bg-primary px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('pengelolaan') }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                <span>Pengelolaan</span>
            </a>
            <a href="#" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Riwayat</span>
            </a>
            <a href="{{ route('profile') }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span>Profile</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="w-full md:ml-64 px-4 py-8">
        <div class="container mx-auto">
            <!-- Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold">Dashboard</h1>
                    <p class="text-gray-600">Aktivitas dalam BonsaRental</p>
                </div>
                <div class="flex items-center mt-4 md:mt-0">
                    <button class="mr-4 p-2 border rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path></svg>
                    </button>
                    <div class="flex items-center">
                        <img src="images/comot.png" alt="Profile" class="w-10 h-10 rounded-full">
                        <div class="ml-3">
                            <h6 class="font-medium">{{ $username }}</h6>
                            <svg class="w-4 h-4 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-primary rounded-lg overflow-hidden text-white">
                    <div class="p-6 flex flex-col md:flex-row justify-between h-full">
                        <div class="mb-4 md:mb-0 md:w-2/3">
                            <h3 class="text-xl font-semibold mb-3">Sewa Perlengkapan Fotografi</h3>
                            <p class="mb-4">Mulai dari Rp 50.000/hari aja!</p>
                            <a href="#" class="inline-block bg-white text-primary hover:bg-light px-4 py-2 rounded-md">Cek sekarang</a>
                        </div>
                        <div class="md:w-1/3 flex justify-center md:justify-end">
                            <img src="images/lens.png" alt="Camera Lens" class="h-32 object-contain">
                        </div>
                    </div>
                </div>
                <div class="bg-accent rounded-lg overflow-hidden text-gray-800">
                    <div class="p-6 flex flex-col md:flex-row justify-between h-full">
                        <div class="mb-4 md:mb-0 md:w-2/3">
                            <h3 class="text-xl font-semibold mb-3">Sewa Perlengkapan Fotografi</h3>
                            <p class="mb-4">Mulai dari Rp 50.000/hari aja!</p>
                            <a href="#" class="inline-block bg-gray-800 text-white hover:bg-gray-700 px-4 py-2 rounded-md">Cek sekarang</a>
                        </div>
                        <div class="md:w-1/3 flex justify-center md:justify-end">
                            <img src="images/lens.png" alt="Camera Lens" class="h-32 object-contain">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rental History -->
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
                                <th class="px-4 py-2 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rentalHistory as $history)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $history['tanggal'] }}</td>
                                <td class="px-4 py-3">{{ $history['barang'] }}</td>
                                <td class="px-4 py-3">{{ number_format($history['harga'], 0, ',', '.') }}</td>
                                <td class="px-4 py-3">{{ $history['penyewa'] }}</td>
                                <td class="px-4 py-3">
                                    <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $history['status'] }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-right mt-4">
                    <a href="#" class="text-primary hover:underline">Lihat Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
