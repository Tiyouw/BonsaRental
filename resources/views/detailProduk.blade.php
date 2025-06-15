@extends('layouts.app')

@section('title', 'Detail Produk - BonsaRental')

@section('content')
<x-navbar />
<div class="pt-24 px-4 max-w-5xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('dashboardPelanggan') }}" class="inline-flex items-center text-gray-700 hover:text-gray-900">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" >
                <path d="M15 18l-6-6 6-6"></path>
            </svg>
            Kembali ke Dashboard
        </a>
    </div>
    <h1 class="text-3xl font-bold text-primary mb-8">{{ $produk->nama_produk }}</h1>

    <div class="flex flex-col md:flex-row gap-8">
        <!-- Gambar di kiri -->
        <div class="md:w-1/2">
            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="w-full h-auto rounded-md object-cover shadow-md">
        </div>

        <!-- Informasi di kanan -->
        <div class="md:w-1/2 flex flex-col justify-between">
            <div>
                <p class="text-gray-700 mb-4">{{ $produk->deskripsi }}</p>

                <p class="text-lg font-semibold text-primary mb-4">
                    Harga: Rp {{ number_format($produk->harga_per_hari, 0, ',', '.') }} / hari
                </p>
                <p class="text-red-700 mb-4">Stok tersedia: {{ $produk->stock }}</p>
                <p class="mb-6">
                    Nomor Rekening Admin: <strong>1234567890 (Bank BCA)</strong>
                </p>

                @if($produk->stock > 0)
                    <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <input type="hidden" name="products[0][id_produk]" value="{{ $produk->id_produk }}">
                        
                        <div>
                            <label for="products[0][jumlah]" class="block text-sm font-medium text-gray-700">Jumlah Unit</label>
                            <input type="number" 
                                   name="products[0][jumlah]" 
                                   id="products[0][jumlah]" 
                                   min="1" 
                                   max="{{ $produk->stock }}" 
                                   value="1"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            @error('products.0.jumlah')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tanggal_booking" class="block text-sm font-medium text-gray-700">Tanggal Mulai Sewa</label>
                            <input type="date" 
                                   name="tanggal_booking" 
                                   id="tanggal_booking"
                                   min="{{ date('Y-m-d') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            @error('tanggal_booking')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tanggal_kembali" class="block text-sm font-medium text-gray-700">Tanggal Kembali</label>
                            <input type="date" 
                                   name="tanggal_kembali" 
                                   id="tanggal_kembali"
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            @error('tanggal_kembali')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="bukti_pembayaran" class="block text-sm font-medium text-gray-700">Upload Bukti Transfer</label>
                            <input type="file" 
                                   name="bukti_pembayaran" 
                                   id="bukti_pembayaran"
                                   accept="image/*"
                                   class="mt-1 block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-md file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-primary file:text-white
                                          hover:file:bg-primary/80">
                            @error('bukti_pembayaran')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" 
                                class="w-full bg-primary text-white px-6 py-3 rounded-md hover:bg-primary/80 transition-colors">
                            Booking Sekarang
                        </button>
                    </form>
                @else
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <strong class="font-bold">Maaf!</strong>
                        <span class="block sm:inline"> Produk ini sedang tidak tersedia.</span>
                    </div>
                @endif

                @if(session('success'))
                    <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm mx-auto relative text-center">
        <button onclick="document.getElementById('successModal').style.display='none'"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">
            &times;
        </button>

        <h2 class="text-xl font-semibold mb-4">Booking berhasil!</h2>
        <p class="mb-6">Mohon konfirmasi ke admin melalui nomor dibawah ini untuk proses lebih lanjut:</p>
        <p class="font-bold mb-6">081234567890 (Admin Bonsa Rental)</p>

        <a href="https://wa.me/081234567890" target="_blank"
            class="inline-block bg-primary text-white px-4 py-2 rounded hover:bg-primary/80">
            Hubungi Admin via WhatsApp
        </a>
    </div>
</div>

<script>
    window.onclick = function(event) {
        const modal = document.getElementById('successModal');
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
</script>
@endif
@endsection
