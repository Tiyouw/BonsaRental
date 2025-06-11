@extends('layouts.app')

@section('title', 'Profile - BonsaRental')

@section('content')
<div class="flex">
    <div class="hidden md:block w-64 bg-dark min-h-screen fixed">
        <div class="flex flex-col">
            <a href="{{ route('dashboard') }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('pengelolaan') }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                <span>Pengelolaan</span>
            </a>
            <a href="{{ route('riwayatAdmin') }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <span>Riwayat</span>
            </a>
            <a href="{{ route('profile') }}" class="flex items-center text-white bg-primary px-4 py-4">
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
    <div class="flex-1 md:ml-64 p-8 pt-16">
        <h1 class="text-3xl font-bold text-primary mb-8">Profil Admin</h1>

        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Informasi Akun</h2>
            <div class="space-y-4">
                <div>
                    <label class="text-gray-600">Username</label>
                    <input type="text" value="{{ $user->username }}" class="w-full px-4 py-2 bg-gray-100 border rounded-md" disabled>
                </div>
                <div>
                    <label class="text-gray-600">Email</label>
                    <input type="email" value="{{ $user->email }}" class="w-full px-4 py-2 bg-gray-100 border rounded-md" disabled>
                </div>
                <div>
                    <label class="text-gray-600">Nama Lengkap</label>
                    <input type="text" value="{{ $user->nama_lengkap ?? 'N/A' }}" class="w-full px-4 py-2 bg-gray-100 border rounded-md" disabled>
                </div>
                <div>
                    <label class="text-gray-600">No. Telepon</label>
                    <input type="text" value="{{ $user->no_telepon ?? 'N/A' }}" class="w-full px-4 py-2 bg-gray-100 border rounded-md" disabled>
                </div>
                <div>
                    <label class="text-gray-600">Alamat</label>
                    <textarea class="w-full px-4 py-2 bg-gray-100 border rounded-md" rows="3" disabled>{{ $user->alamat ?? 'N/A' }}</textarea>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Aktivitas Terakhir</h2>
            <div class="space-y-2">
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
@endsection
