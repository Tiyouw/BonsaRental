@extends('layouts.app')

@section('title', 'Profile - BonsaRental')

@section('content')
<div class="flex">
    <div class="hidden md:block w-64 bg-dark min-h-screen fixed">
        <div class="flex flex-col">
            <a href="{{ route('dashboard', ['username' => $username]) }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('pengelolaan', ['username' => $username]) }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                <span>Pengelolaan</span>
            </a>
            <a href="{{ route ('riwayatAdmin', ['username' => $username]) }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Riwayat</span>
            </a>
            <a href="{{ route('profile', ['username' => $username]) }}" class="flex items-center text-white bg-primary px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span>Profile</span>
            </a>
        </div>
    </div>

    <div class="w-full md:ml-64 px-4 py-8">
        <div class="container mx-auto">
            <div class="mb-8">
                <h1 class="text-2xl font-bold">Profil Pengguna</h1>
                <p class="text-gray-600">Kelola informasi akun Anda</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="text-center mb-8">
                    <img src="images/comot.png" alt="Profile" class="w-24 h-24 rounded-full mx-auto mb-4">
                    <p class="text-2xl font-semibold">Selamat datang, <span class="text-primary">{{ $username }}</span>!</p>
                    <p class="text-gray-600">Member sejak Januari 2024</p>
                </div>

                <div class="max-w-2xl mx-auto">
                    <form>
                        <div class="mb-6">
                            <label for="fullName" class="block text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" id="fullName" value="{{ $username }}" class="w-full px-4 py-2 bg-gray-100 border rounded-md" disabled>
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" value="{{ strtolower(str_replace(' ', '', $username)) }}@example.com" class="w-full px-4 py-2 bg-gray-100 border rounded-md" disabled>
                        </div>
                        <div class="mb-6">
                            <label for="phone" class="block text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="tel" id="phone" value="08123456789" class="w-full px-4 py-2 bg-gray-100 border rounded-md" disabled>
                        </div>
                        <div class="mb-6">
                            <label for="address" class="block text-gray-700 mb-2">Alamat</label>
                            <textarea id="address" rows="3" class="w-full px-4 py-2 bg-gray-100 border rounded-md resize-none" disabled>Jl. Contoh No. 123, Kota Surabaya</textarea>
                        </div>
                        <button type="button" class="w-full py-3 bg-primary text-white font-medium rounded-md hover:bg-secondary transition-colors">Edit Profil</button>
                        <a href="{{ route('logout') }}"
                            onclick="return confirm('Apakah Anda yakin ingin logout?')"
                            class="block w-full text-center mt-4 py-3 bg-red-600 text-white font-medium rounded-md hover:bg-red-700 transition-colors">
                            Logout
                        </a>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 mt-8">
                <h3 class="text-xl font-semibold mb-6">Aktivitas Terbaru</h3>
                <div class="space-y-4">
                    <div class="p-4 border-b">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-medium">Penyewaan Canon 60D</h4>
                                <p class="text-sm text-gray-600">30 April 2024</p>
                            </div>
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Selesai</span>
                        </div>
                    </div>
                    <div class="p-4 border-b">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-medium">Penyewaan Canon 18-55mm</h4>
                                <p class="text-sm text-gray-600">20 Mei 2024</p>
                            </div>
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Selesai</span>
                        </div>
                    </div>
                    <div class="p-4 border-b">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-medium">Update Profil</h4>
                                <p class="text-sm text-gray-600">15 Mei 2024</p>
                            </div>
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">Info</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
