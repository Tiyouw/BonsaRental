@extends('layouts.app')

@section('title', 'Profile - BonsaRental')

@section('content')
<div class="flex">
    <div class="hidden md:block w-64 bg-dark min-h-screen fixed">
        <div class="flex flex-col">
            <a href="{{ route('dashboard', ['username' => $user->username]) }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('pengelolaan', ['username' => $user->username]) }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                <span>Pengelolaan</span>
            </a>
            <a href="{{ route('riwayatAdmin', ['username' => $user->username]) }}" class="flex items-center text-white hover:bg-primary/50 px-4 py-4">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Riwayat</span>
            </a>
            <a href="{{ route('profile', ['username' => $user->username]) }}" class="flex items-center text-white bg-primary px-4 py-4">
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
                <h1 class="text-2xl font-bold">Profil Pengguna</h1>
                <p class="text-gray-600">Kelola informasi akun Anda</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="max-w-2xl mx-auto">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="flex flex-col items-center mb-6">
                            <img src="{{ $user->gambar ? asset('storage/' . $user->gambar) : asset('images/comot.png') }}" class="w-24 h-24 rounded-full mb-4">
                            <input type="file" name="gambar" class="block text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border file:rounded-md file:text-sm file:bg-primary file:text-white hover:file:bg-primary/80" />
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="text-gray-600">Username</label>
                                <input type="text" name="username" value="{{ $user->username }}" class="w-full px-4 py-2 border rounded-md" required>
                            </div>

                            <div>
                                <label class="text-gray-600">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" value="{{ $user->nama_lengkap }}" class="w-full px-4 py-2 border rounded-md" required>
                            </div>

                            <div>
                                <label class="text-gray-600">Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-2 border rounded-md" required>
                            </div>

                            <div>
                                <label class="text-gray-600">No HP</label>
                                <input type="text" name="no_hp" value="{{ $user->no_hp }}" class="w-full px-4 py-2 border rounded-md" required>
                            </div>

                            <div>
                                <label class="text-gray-600">Alamat</label>
                                <textarea name="alamat" rows="3" class="w-full px-4 py-2 border rounded-md" required>{{ $user->alamat }}</textarea>
                            </div>
                        </div>

                        <div class="flex justify-end gap-4 mt-6">
                            <a
                                onclick="window.location.href='{{ route('profile') }}'"
                                class="py-2 px-4 bg-red-600 text-white rounded hover:bg-red-700">
                                Batal
                            </a>
                            <button type="submit" class="py-2 px-4 bg-green-600 text-white rounded hover:bg-green-700">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

@if (session('success'))
<div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6 text-center">
        <div class="flex justify-center mb-4">
            <img src="https://png.pngtree.com/element_our/20200702/ourlarge/pngtree-green-checkmark-error-image_2284668.jpg"
                 alt="Success"
                 class="w-20 h-20 object-contain rounded-full">
        </div>
        <h2 class="text-xl font-semibold mb-2">Profil anda berhasil diperbarui!</h2>
        <p class="text-gray-600 mb-4">{{ session('success') }}</p>
        <button
            onclick="window.location.href='{{ route('profile') }}'"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 w-full transition duration-200">
            OK
        </button>
    </div>
</div>
@endif
@endsection
