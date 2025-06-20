@extends('layouts.app')

@section('title', 'Profil Admin - BonsaRental')

@section('content')
<div class="container mx-auto px-4 py-8"> {{-- Removed redundant layout wrappers --}}
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-2xl font-bold mb-2">Profil Admin</h1>
                    <p class="text-gray-600">Informasi profil Anda</p>
                </div>
                {{-- Profile picture or initials --}}
                <div class="flex-shrink-0">
                    @php
                        $initials = '';
                        if ($user->nama_lengkap) {
                            $nameParts = explode(' ', $user->nama_lengkap);
                            $initials .= strtoupper(substr($nameParts[0], 0, 1));
                            if (count($nameParts) > 1) {
                                $initials .= strtoupper(substr($nameParts[count($nameParts) - 1], 0, 1));
                            }
                        } else {
                            $initials = strtoupper(substr($user->username, 0, 1));
                        }
                    @endphp
                    @if($user->gambar)
                        <img src="{{ asset('storage/' . $user->gambar) }}" alt="Profile" class="w-24 h-24 rounded-full object-cover shadow-md">
                    @else
                        <div class="w-24 h-24 rounded-full bg-primary flex items-center justify-center text-white text-3xl font-bold shadow-md">
                            {{ $initials }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="mb-8">
                <h2 class="text-lg font-semibold mb-3">Detail Profil</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600">Username</p>
                        <p class="font-medium">{{ $user->username }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Nama Lengkap</p>
                        <p class="font-medium">{{ $user->nama_lengkap }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Nomor HP</p>
                        <p class="font-medium">{{ $user->no_hp }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Alamat</p>
                        <p class="font-medium">{{ $user->alamat }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Role</p>
                        <p class="font-medium">{{ ucfirst($user->role) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Bergabung Sejak</p>
                        <p class="font-medium">{{ $user->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('admin.profile.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit Profil</a>
            </div>
        </div>
    </div>
</div>
@endsection
