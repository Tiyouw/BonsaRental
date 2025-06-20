@extends('layouts.app')

@section('title', 'Detail Pelanggan - BonsaRental')

@section('content')
<div class="container mx-auto px-4 py-8"> {{-- Removed redundant layout wrappers --}}
    <div class="mb-6">
        <a href="{{ route('admin.customers.index') }}" class="inline-flex items-center text-gray-700 hover:text-gray-900">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M15 18l-6-6 6-6"></path>
            </svg>
            Kembali ke Daftar Pelanggan
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-2xl font-bold mb-2">Detail Pelanggan: {{ $customer->nama_lengkap }}</h1>
                    <p class="text-gray-600">Terdaftar sejak: {{ $customer->created_at->format('d M Y H:i') }}</p>
                </div>
                {{-- Profile picture or initials --}}
                <div class="flex-shrink-0">
                    @php
                        $initials = '';
                        if ($customer->nama_lengkap) {
                            $nameParts = explode(' ', $customer->nama_lengkap);
                            $initials .= strtoupper(substr($nameParts[0], 0, 1));
                            if (count($nameParts) > 1) {
                                $initials .= strtoupper(substr($nameParts[count($nameParts) - 1], 0, 1));
                            }
                        } else {
                            $initials = strtoupper(substr($customer->username, 0, 1));
                        }
                    @endphp
                    @if($customer->gambar)
                        <img src="{{ asset('storage/' . $customer->gambar) }}" alt="Profile" class="w-20 h-20 rounded-full object-cover shadow-md">
                    @else
                        <div class="w-20 h-20 rounded-full bg-primary flex items-center justify-center text-white text-xl font-bold shadow-md">
                            {{ $initials }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Informasi Dasar Pelanggan -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold mb-3">Informasi Dasar</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600">Username</p>
                        <p class="font-medium">{{ $customer->username }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Nama Lengkap</p>
                        <p class="font-medium">{{ $customer->nama_lengkap }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Nomor HP</p>
                        <p class="font-medium">{{ $customer->no_hp }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Alamat</p>
                        <p class="font-medium">{{ $customer->alamat }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
