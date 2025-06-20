@extends('layouts.app')

@section('title', 'Edit Profil Admin - BonsaRental')

@section('content')
<div class="container mx-auto px-4 py-8"> {{-- Removed redundant layout wrappers --}}
    <div class="mb-6">
        <a href="{{ route('admin.profile') }}" class="inline-flex items-center text-gray-700 hover:text-gray-900">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M15 18l-6-6 6-6"></path>
            </svg>
            Kembali ke Profil
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Edit Profil Admin</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
                <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight focus:outline-none focus:shadow-outline cursor-not-allowed" readonly disabled>
                <p class="text-xs text-gray-500 mt-1">Username tidak dapat diubah.</p>
            </div>

            <div class="mb-4">
                <label for="nama_lengkap" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap:</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="no_hp" class="block text-gray-700 text-sm font-bold mb-2">Nomor HP:</label>
                <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat:</label>
                <textarea id="alamat" name="alamat" rows="3"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('alamat', $user->alamat) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">Gambar Profil (Biarkan kosong jika tidak ingin mengubah):</label>
                <input type="file" id="gambar" name="gambar"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, JPEG. Maks: 2MB.</p>
                @if($user->gambar)
                    <div class="mt-2">
                        <p class="text-sm text-gray-600">Gambar saat ini:</p>
                        <img src="{{ asset('storage/' . $user->gambar) }}" alt="Profil Pengguna" class="w-24 h-auto object-cover rounded">
                    </div>
                @endif
            </div>

            <h2 class="text-lg font-semibold mb-3 mt-6">Ubah Password</h2>
            <div class="mb-4">
                <label for="current_password" class="block text-gray-700 text-sm font-bold mb-2">Password Saat Ini:</label>
                <input type="password" id="current_password" name="current_password"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="new_password" class="block text-gray-700 text-sm font-bold mb-2">Password Baru:</label>
                <input type="password" id="new_password" name="new_password"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-6">
                <label for="new_password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password Baru:</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-primary hover:bg-primary/80 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Profil
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
