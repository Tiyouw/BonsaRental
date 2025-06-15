@extends('layouts.app')

@section('title', 'Edit Profil Pelanggan - BonsaRental')

@section('content')
<x-navbar />
<div class="container mx-auto py-10">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold text-primary mb-6">Edit Profil Pelanggan</h1>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex flex-col items-center mb-6">
                <img src="{{ $user->gambar ? asset('storage/' . $user->gambar) : asset('images/comot.png') }}" class="w-24 h-24 rounded-full mb-4">
                <input type="file" name="gambar" class="block text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border file:rounded-md file:text-sm file:bg-primary file:text-white hover:file:bg-primary/80" />
            </div>

            <div class="space-y-4">
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
                    onclick="window.location.href='{{ route('profilePelanggan') }}'"
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

{{-- Modal untuk notifikasi sukses --}}
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
            onclick="window.location.href='{{ route('profilePelanggan') }}'"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 w-full transition duration-200">
            OK
        </button>
    </div>
</div>
@endif
@endsection
