@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 mt-16">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Form Booking</h1>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
            <!-- Product Info -->
            <div class="p-6 border-b">
                <div class="flex">
                    <img 
                        src="{{ asset('storage/' . $product->gambar) }}" 
                        alt="{{ $product->nama_produk }}"
                        class="w-32 h-32 object-cover rounded-lg"
                    >
                    <div class="ml-6">
                        <h2 class="text-xl font-semibold mb-2">{{ $product->nama_produk }}</h2>
                        <p class="text-gray-600 mb-2">{{ $product->deskripsi }}</p>
                        <p class="text-blue-600 font-bold">
                            Rp {{ number_format($product->harga_per_hari, 0, ',', '.') }}/hari
                        </p>
                        <p class="text-sm text-gray-500">Stok tersedia: {{ $product->stock }}</p>
                    </div>
                </div>
            </div>

            <!-- Booking Form -->
            <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <input type="hidden" name="id_produk" value="{{ $product->id_produk }}">

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <!-- Tanggal Booking -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Booking
                        </label>
                        <input 
                            type="date" 
                            name="tanggal_booking"
                            min="{{ date('Y-m-d') }}"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        >
                    </div>

                    <!-- Tanggal Kembali -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Kembali
                        </label>
                        <input 
                            type="date" 
                            name="tanggal_kembali"
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        >
                    </div>
                </div>

                <!-- Jumlah Unit -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Jumlah Unit
                    </label>
                    <input 
                        type="number" 
                        name="jumlah"
                        min="1"
                        max="{{ $product->stock }}"
                        value="1"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                    >
                </div>

                <!-- Bukti Pembayaran -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Upload Bukti Pembayaran
                    </label>
                    <input 
                        type="file" 
                        name="bukti_pembayaran"
                        accept="image/*"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                    >
                    <p class="mt-1 text-sm text-gray-500">
                        Format yang diterima: JPG, PNG. Maksimal 2MB.
                    </p>
                </div>

                <!-- Total Price Preview -->
                <div class="mb-6 p-4 bg-gray-50 rounded-md">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700">Total Harga:</span>
                        <span class="text-xl font-bold text-blue-600" id="totalPrice">
                            Rp 0
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">
                        *Total akan dihitung berdasarkan jumlah hari dan unit yang dipilih
                    </p>
                </div>

                <div class="flex justify-end">
                    <button 
                        type="submit"
                        class="bg-blue-600 text-white py-2 px-6 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        Proses Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const pricePerDay = {{ $product->harga_per_hari }};
    const quantityInput = document.querySelector('input[name="jumlah"]');
    const startDateInput = document.querySelector('input[name="tanggal_booking"]');
    const endDateInput = document.querySelector('input[name="tanggal_kembali"]');
    const totalPriceElement = document.getElementById('totalPrice');

    function calculateTotal() {
        const quantity = parseInt(quantityInput.value) || 0;
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);

        if (startDate && endDate && startDate <= endDate) {
            const days = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
            const total = pricePerDay * quantity * days;
            totalPriceElement.textContent = `Rp ${total.toLocaleString('id-ID')}`;
        } else {
            totalPriceElement.textContent = 'Rp 0';
        }
    }

    quantityInput.addEventListener('input', calculateTotal);
    startDateInput.addEventListener('input', calculateTotal);
    endDateInput.addEventListener('input', calculateTotal);
});
</script>
@endsection
