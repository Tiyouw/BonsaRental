@extends('layouts.app')

@section('title', 'Edit Profile Admin - BonsaRental')

@section('content')
<div class="flex">
     <x-admin_sidebar />

    <div class="w-full md:ml-64 px-4 py-8">
        <div class="container mx-auto">
            <div class="mb-8">
                <h1 class="text-2xl font-bold">Edit Profil Admin</h1>
                <p class="text-gray-600">Perbarui informasi akun Anda</p>
            </div>

            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="max-w-2xl mx-auto">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="flex flex-col items-center mb-6">
                            <img src="{{ $user->gambar ? asset('storage/' . $user->gambar) : asset('images/comot.png') }}"
                                 class="w-24 h-24 rounded-full mb-4">
                            <input type="file" name="gambar"
                                   class="block text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border file:rounded-md file:text-sm file:bg-primary file:text-white hover:file:bg-primary/80" />
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="text-gray-600">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}"
                                       class="w-full px-4 py-2 border rounded-md @error('nama_lengkap') border-red-500 @enderror" required>
                            </div>

                            <div>
                                <label class="text-gray-600">No HP</label>
                                <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                                       class="w-full px-4 py-2 border rounded-md @error('no_hp') border-red-500 @enderror" required>
                            </div>

                            <div>
                                <label class="text-gray-600">Alamat</label>
                                <textarea name="alamat" rows="3"
                                          class="w-full px-4 py-2 border rounded-md @error('alamat') border-red-500 @enderror" required>{{ old('alamat', $user->alamat) }}</textarea>
                            </div>

                            <!-- Password Section -->
                            <div class="border-t pt-4">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Ubah Password</h3>
                                <p class="text-sm text-gray-500 mb-4">Kosongkan bagian ini jika tidak ingin mengubah password</p>

                                <div class="space-y-4">
                                    <div>
                                        <label class="text-gray-600">Password Saat Ini</label>
                                        <input type="password" name="current_password"
                                               class="w-full px-4 py-2 border rounded-md @error('current_password') border-red-500 @enderror">
                                    </div>

                                    <div>
                                        <label class="text-gray-600">Password Baru</label>
                                        <input type="password" name="new_password"
                                               class="w-full px-4 py-2 border rounded-md @error('new_password') border-red-500 @enderror">
                                    </div>

                                    <div>
                                        <label class="text-gray-600">Konfirmasi Password Baru</label>
                                        <input type="password" name="new_password_confirmation"
                                               class="w-full px-4 py-2 border rounded-md">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-4 mt-6">
                            <a href="{{ route('admin.profile') }}"
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
        </div>
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
        <h2 class="text-xl font-semibold mb-2">Profil berhasil diperbarui!</h2>
        <p class="text-gray-600 mb-4">{{ session('success') }}</p>
        <button onclick="window.location.href='{{ route('admin.profile') }}'"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 w-full transition duration-200">
            OK
        </button>
    </div>
</div>
@endif
@endsection
