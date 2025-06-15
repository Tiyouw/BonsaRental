@extends('layouts.app')

@section('title', 'Profil Pelanggan - BonsaRental')

@section('content')
<div class="container mx-auto py-10">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold text-primary mb-6">Profil Pelanggan</h1>

        <div class="flex flex-col items-center mb-6">
            <img src="{{ $user->gambar ? asset('storage/' . $user->gambar) : asset('images/comot.png') }}"
            class="w-24 h-24 rounded-full mb-4">
            <p class="text-xl font-semibold">Halo, {{ $user->nama_lengkap }}!</p>
            <p class="text-gray-500">Member sejak {{ $user->created_at->format('F Y') }}</p>
        </div>

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
            <a href="{{ route('profile') }}"
               class="py-2 px-4 bg-blue-600 text-white rounded hover:bg-blue-700">
                Edit Profil
            </a>
        </div>
    </div>
</div>
@endsection
