@extends('layouts.app')

@section('title', 'Profil Pelanggan - BonsaRental')

@section('content')
<x-navbar />
<div class="container mx-auto py-10">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold text-primary mb-6">Profil Pelanggan</h1>

        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/comot.png') }}" alt="Foto Profil" class="w-24 h-24 rounded-full mb-4">
            <p class="text-xl font-semibold">Halo, {{ $user->username }}!</p>
            <p class="text-gray-500">Member sejak {{ $user->created_at->format('F Y') }}</p>
        </div>

        <div class="space-y-4">
            <div>
                <label class="text-gray-600">Nama Lengkap</label>
                <input type="text" value="{{ $user->nama_lengkap ?? 'N/A' }}" class="w-full px-4 py-2 bg-gray-100 border rounded-md" disabled>
            </div>

            <div>
                <label class="text-gray-600">Email</label>
                <input type="email" value="{{ $user->email }}" class="w-full px-4 py-2 bg-gray-100 border rounded-md" disabled>
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
        <a href="{{ route('logout') }}" class="mt-8 block w-full text-center bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors">Logout</a>
    </div>
</div>
@endsection
