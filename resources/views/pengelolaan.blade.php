@extends('layouts.app')

@section('title', 'Pengelolaan Katalog - BonsaRental')

@section('content')
<div class="flex mt-16">
    <div class="hidden md:block w-64 bg-dark min-h-screen fixed">
        <div class="flex flex-col">
            <a href="{{ route('dashboard', ['username' => $username]) }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('pengelolaan', ['username' => $username]) }}" class="flex items-center text-white bg-primary px-4 py-4">
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
            <a href="{{ route('profile', ['username' => $username]) }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span>Profile</span>
            </a>
        </div>
    </div>
    <div class="w-full md:ml-64 px-4 py-8">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold">Pengelolaan Katalog</h1>
                    <p class="text-gray-600">Kelola item yang tersedia untuk disewa</p>
                </div>
                <button class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded-md mt-4 md:mt-0 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Item
                </button>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <select class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
                            <option selected>Semua Kategori</option>
                            <option>Kamera</option>
                            <option>Lensa</option>
                            <option>Lighting</option>
                            <option>Aksesoris</option>
                        </select>
                    </div>
                    <div>
                        <select class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
                            <option selected>Status Stok</option>
                            <option>Tersedia</option>
                            <option>Hampir Habis</option>
                            <option>Habis</option>
                        </select>
                    </div>
                    <div>
                        <div class="relative">
                            <input type="text" placeholder="Cari item..." class="w-full border rounded-md pl-4 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
                            <button class="absolute right-3 top-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="overflow-x-auto">
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
                            @foreach($catalogItems as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $item['id'] }}</td>
                                <td class="px-4 py-3">
                                    @if($item['kategori'] == 'Kamera')
                                        <img src="{{ asset($item['gambar']) }}" alt="{{ $item['nama'] }}" alt="{{ $item['nama'] }}" class="w-14 h-14 object-cover rounded">
                                    @elseif($item['kategori'] == 'Lensa')
                                        <img src="{{ asset($item['gambar']) }}" alt="{{ $item['nama'] }}" alt="{{ $item['nama'] }}" class="w-14 h-14 object-cover rounded">
                                    @elseif($item['kategori'] == 'Lighting')
                                        <img src="{{ asset($item['gambar']) }}" alt="{{ $item['nama'] }}" alt="{{ $item['nama'] }}" class="w-14 h-14 object-cover rounded">
                                    @else
                                        <img src="{{ asset($item['gambar']) }}" alt="{{ $item['nama'] }}" alt="{{ $item['nama'] }}" class="w-14 h-14 object-cover rounded">
                                    @endif
                                </td>
                                <td class="px-4 py-3">{{ $item['nama'] }}</td>
                                <td class="px-4 py-3">{{ $item['kategori'] }}</td>
                                <td class="px-4 py-3">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    @if($item['stok'] > 5)
                                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $item['stok'] }}</span>
                                    @elseif($item['stok'] > 0)
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $item['stok'] }}</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $item['stok'] }}</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex space-x-2">
                                        <button class="px-3 py-1 border border-blue-500 text-blue-500 rounded-md hover:bg-blue-500 hover:text-white transition-colors">Edit</button>
                                        <button class="px-3 py-1 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
