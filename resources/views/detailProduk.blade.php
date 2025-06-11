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
    <h1 class="text-3xl font-bold text-primary mb-8">{{ $produk->nama }}</h1>

    <div class="flex flex-col md:flex-row gap-8">
        <div class="md:w-1/2">
            <img src="{{ asset('storage/' . $produk->gambar_path) }}" alt="{{ $produk->nama }}" class="w-full h-auto rounded-md object-cover shadow-md">
        </div>

        <div class="md:w-1/2 flex flex-col justify-between">
            <div>
                <p class="text-gray-700 mb-4">{{ $produk->deskripsi }}</p>

                <p class="text-lg text-gray-800 font-semibold mb-2">Kategori: {{ $produk->kategori }}</p>
                <p class="text-xl font-bold text-primary mb-4">Harga: Rp {{ number_format($produk->harga_per_hari, 0, ',', '.') }} / hari</p>

                <p class="text-lg text-gray-800 font-semibold">Stok:
                    @if ($produk->stok > 0)
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-base">Tersedia ({{ $produk->stok }})</span>
                    @else
                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-base">Tidak Tersedia</span>
                    @endif
                </p>
            </div>

            <div class="mt-8">
                @if ($produk->stok > 0)
                    <button onclick="document.getElementById('rentModal').style.display='flex'" class="bg-primary text-white px-6 py-3 rounded-md hover:bg-primary/80 transition-colors mr-4">Sewa Sekarang</button>
                @else
                    <button class="bg-gray-400 text-white px-6 py-3 rounded-md cursor-not-allowed" disabled>Stok Habis</button>
                @endif
            </div>

            <div id="rentModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm mx-auto relative">
                    <button onclick="document.getElementById('rentModal').style.display='none'" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">
                        &times;
                    </button>
                    <h2 class="text-xl font-semibold mb-4">Informasi Pembayaran</h2>
                    <p class="mb-4">Silakan transfer sejumlah <span class="font-bold text-primary">Rp {{ number_format($produk->harga_per_hari, 0, ',', '.') }}</span> ke rekening berikut:</p>
                    <p class="text-lg font-bold mb-6">Bank ABC - 1234567890 (a/n Bonsa Rental)</p>

                    <form action="{{ route('uploadBukti', $produk->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="bukti_transfer" class="block text-gray-700 text-sm font-bold mb-2">Unggah Bukti Transfer</label>
                            <input type="file" name="bukti_transfer" id="bukti_transfer" accept="image/*" class="w-full px-3 py-2 border rounded-md" required>
                        </div>
                        @error('bukti_transfer')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-primary/80 w-full">Konfirmasi Pembayaran</button>
                    </form>
                </div>
            </div>

            @if(session('success'))
                <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm mx-auto relative text-center">
                        <button onclick="document.getElementById('successModal').style.display='none'"
                            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">
                            &times;
                        </button>

                        <h2 class="text-xl font-semibold mb-4">Bukti transfer berhasil diunggah</h2>
                        <p class="mb-6">Mohon konfirmasi ke admin melalui nomor di bawah ini untuk proses lebih lanjut:</p>
                        {{-- Ambil nomor telepon admin dari config atau database jika ada --}}
                        <p class="font-bold mb-6">081234567890 (Admin Bonsa Rental)</p>

                        <a href="https://wa.me/6281234567890" target="_blank"
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
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
