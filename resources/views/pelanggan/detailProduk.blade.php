@extends('layouts.app')

@section('title', 'Detail Produk - BonsaRental')

@section('content')
<x-navbar />
<div class="pt-24 px-4 max-w-5xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('dashboardPelanggan') }}" class="inline-flex items-center text-gray-700 hover:text-gray-900">
            <!-- Icon panah kiri -->
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" >
                <path d="M15 18l-6-6 6-6"></path>
            </svg>
            Kembali ke Dashboard
        </a>
    </div>
    <h1 class="text-3xl font-bold text-primary mb-8">{{ $produk['nama'] }}</h1>

    <div class="flex flex-col md:flex-row gap-8">
        <!-- Gambar di kiri -->
        <div class="md:w-1/2">
            <img src="{{ asset($produk['gambar']) }}" alt="{{ $produk['nama'] }}" class="w-full h-auto rounded-md object-cover shadow-md">
        </div>

        <!-- Informasi di kanan -->
        <div class="md:w-1/2 flex flex-col justify-between">
            <div>
                <p class="text-gray-700 mb-4">{{ $produk['deskripsi'] }}</p>

                <p class="text-lg font-semibold text-primary mb-4">
                    Harga: Rp {{ number_format($produk['harga'], 0, ',', '.') }}
                </p>
                <P class="text-red-700 mb-4">{{ $produk['stok'] }}</P>
                <p class="mb-6">
                    Nomor Rekening Admin: <strong>1234567890 (Bank ABC)</strong>
                </p>

                <form action="{{ route('uploadBukti', $produk['id']) }}" method="POST" enctype="multipart/form-data" class="mb-6">
                    @csrf
                    <label for="bukti_transfer" class="block mb-2 font-medium">Upload Bukti Transfer:</label>
                    <input
                        type="file"
                        name="bukti_transfer"
                        id="bukti_transfer"
                        required
                        class="border border-gray-300 rounded p-2 w-full mb-3"
                        accept="image/*"
                    >
                    @error('bukti_transfer')
                        <div class="text-red-500 mb-2">{{ $message }}</div>
                    @enderror
                    <button
                        type="submit"
                        class="bg-primary text-white px-6 py-2 rounded hover:bg-primary/80 transition"
                    >
                        Kirim Bukti
                    </button>
                </form>

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('success'))
                <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm mx-auto relative text-center">
                        <button onclick="document.getElementById('successModal').style.display='none'"
                            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">
                            &times;
                        </button>

                        <h2 class="text-xl font-semibold mb-4">Bukti transfer berhasil diunggah</h2>
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
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
