@extends('layouts.app')

@section('title', 'Profile - BonsaRental')

@section('content')
<div class="flex">
    <div class="hidden md:block w-64 bg-dark min-h-screen fixed">
        <div class="flex flex-col">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('pengelolaan.index') }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                <span>Pengelolaan</span>
            </a>
            <a href="{{ route('admin.bookings.index') }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Riwayat</span>
            </a>
            <a href="{{ route('admin.profile') }}" class="flex items-center text-white bg-primary px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span>Profile</span>
            </a>
        </div>
    </div>

    <div class="w-full md:ml-64 px-4 py-8">
        <div class="container mx-auto">
            <div class="mb-8">
                <h1 class="text-2xl font-bold">Profil Admin</h1>
                <p class="text-gray-600">Kelola informasi akun Anda</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-col items-center mb-6">
                    <img src="{{ $user->gambar ? asset('storage/' . $user->gambar) : asset('images/comot.png') }}"
                    class="w-24 h-24 rounded-full mb-4">
                    <p class="text-xl font-semibold">Halo, {{ $user->nama_lengkap }}!</p>
                    <p class="text-gray-500">Admin sejak {{ $user->created_at->format('F Y') }}</p>
                </div>

                <div class="max-w-2xl mx-auto">
                    <div class="space-y-4">
                        <div>
                            <label class="text-gray-600">Nama Lengkap</label>
                            <input type="text" value="{{ $user->nama_lengkap }}" class="w-full px-4 py-2 bg-gray-100 border rounded-md" disabled>
                        </div>
                        <div>
                            <label class="text-gray-600">Email</label>
                            <input type="text" value="{{ $user->email }}" class="w-full px-4 py-2 bg-gray-100 border rounded-md" disabled>
                        </div>
                        <div>
                            <label class="text-gray-600">No. Telepon</label>
                            <input type="text" value="{{ $user->no_hp }}" class="w-full px-4 py-2 bg-gray-100 border rounded-md" disabled>
                        </div>
                        <div>
                            <label class="text-gray-600">Alamat</label>
                            <textarea class="w-full px-4 py-2 bg-gray-100 border rounded-md" rows="3" disabled>{{ $user->alamat }}</textarea>
                        </div>

                        <div class="mt-6 flex justify-between">
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" 
                                    onclick="return confirm('Apakah Anda yakin ingin logout?')"
                                    class="py-2 px-4 bg-red-600 text-white rounded hover:bg-red-700">
                                    Logout
                                </button>
                            </form>
                            <a href="{{ route('admin.profile.edit') }}"
                               class="py-2 px-4 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Edit Profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 mt-8">
                <h3 class="text-xl font-semibold mb-6">Aktivitas Terbaru</h3>
                <div class="space-y-4">
                    @foreach($user->bookings()->latest()->take(5)->get() as $booking)
                    <div class="p-4 border-b">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-medium">{{ $booking->produk->nama_produk }}</h4>
                                <p class="text-sm text-gray-600">{{ $booking->created_at->format('d F Y') }}</p>
                            </div>
                            <span class="bg-{{ $booking->status_color }}-100 text-{{ $booking->status_color }}-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                {{ $booking->status }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
