@extends('layouts.app')

@section('title', 'Profil Pelanggan - BonsaRental')

@section('content')
<x-navbar />
<div class="container mx-auto py-10">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold text-primary mb-6">Profil Pelanggan</h1>

        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/comot.png') }}" alt="Foto Profil" class="w-24 h-24 rounded-full mb-4">
            <p class="text-xl font-semibold">Halo, {{ $username }}!</p>
            <p class="text-gray-500">Member sejak Januari 2024</p>
        </div>

        <div class="space-y-4">
            <div>
                <label class="text-gray-600">Nama Lengkap</label>
                <input type="text" value="{{ $username }}" class="w-full px-4 py-2 bg-gray-100 border rounded-md" disabled>
            </div>

            <div>
                <label class="text-gray-600">Email</label>
                <input type="text" value="{{ strtolower(str_replace(' ', '', $username)) }}@example.com" class="w-full px-4 py-2 bg-gray-100 border rounded-md" disabled>
            </div>

            <div>
                <label class="text-gray-600">No. Telepon</label>
                <input type="text" value="08123456789" class="w-full px-4 py-2 bg-gray-100 border rounded-md" disabled>
            </div>

            <div>
                <label class="text-gray-600">Alamat</label>
                <textarea class="w-full px-4 py-2 bg-gray-100 border rounded-md" rows="3" disabled>Jl. Contoh No. 123, Kota Surabaya</textarea>
            </div>
        </div>
        <a href="{{ route('logout') }}"
        onclick="return confirm('Apakah Anda yakin ingin logout?')"
        class="block w-full text-center mt-4 py-3 bg-red-600 text-white font-medium rounded-md hover:bg-red-700 transition-colors">
        Logout
        </a>
    </div>
</div>
@endsection
