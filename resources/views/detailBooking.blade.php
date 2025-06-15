@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('riwayatBooking') }}" class="inline-flex items-center text-gray-700 hover:text-gray-900">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M15 18l-6-6 6-6"></path>
            </svg>
            Kembali ke Riwayat Booking
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-start mb-6">
            <h1 class="text-2xl font-bold">Detail Booking #{{ $booking->id_booking }}</h1>
            <div class="flex flex-col items-end space-y-2">
                @php $statusBooking = $booking->getStatusBookingLabel(); @endphp
                <span class="px-3 py-1 rounded-full text-sm font-semibold
                    bg-{{ $statusBooking['color'] }}-100 text-{{ $statusBooking['color'] }}-800">
                    Status Booking: {{ $statusBooking['text'] }}
                </span>
                @if($booking->isDisetujui())
                    @php $statusSewa = $booking->getStatusSewaLabel(); @endphp
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        bg-{{ $statusSewa['color'] }}-100 text-{{ $statusSewa['color'] }}-800">
                        Status Sewa: {{ $statusSewa['text'] }}
                    </span>
                @endif
            </div>
        </div>

        <!-- Booking Information -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-3">Informasi Booking</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600">Tanggal Booking</p>
                    <p class="font-medium">{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Tanggal Kembali</p>
                    <p class="font-medium">{{ \Carbon\Carbon::parse($booking->tanggal_kembali)->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Total Harga</p>
                    <p class="font-medium">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Products List -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-3">Produk yang Dibooking</h2>
            <div class="space-y-4">
                @foreach($booking->detailBookings as $detail)
                    <div class="border rounded p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                @if($detail->produk->gambar)
                                    <img src="{{ asset('storage/' . $detail->produk->gambar) }}" 
                                         alt="{{ $detail->produk->nama_produk }}"
                                         class="w-16 h-16 object-cover rounded mr-4">
                                @endif
                                <div>
                                    <h3 class="font-medium">{{ $detail->produk->nama_produk }}</h3>
                                    <p class="text-sm text-gray-600">
                                        {{ $detail->jumlah }} unit x Rp {{ number_format($detail->produk->harga_per_hari, 0, ',', '.') }}/hari
                                    </p>
                                </div>
                            </div>
                            <p class="font-medium">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Bukti Pembayaran -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-3">Bukti Pembayaran</h2>
            @if($booking->bukti_pembayaran)
                <img src="{{ asset('storage/' . $booking->bukti_pembayaran) }}" 
                     alt="Bukti Pembayaran" 
                     class="max-w-md rounded shadow-lg">
            @else
                <p class="text-gray-600">Bukti pembayaran belum diupload</p>
            @endif
        </div>

        <!-- Status Timeline -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-3">Status Timeline</h2>
            <div class="relative">
                <div class="absolute left-4 top-0 h-full w-0.5 bg-gray-200"></div>
                <div class="space-y-6 relative">
                    <!-- Booking Created -->
                    <div class="flex items-center">
                        <div class="absolute left-0 w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div class="ml-12">
                            <h3 class="font-medium">Booking Dibuat</h3>
                            <p class="text-sm text-gray-600">{{ $booking->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>

                    <!-- Booking Status -->
                    <div class="flex items-center">
                        <div class="absolute left-0 w-8 h-8 rounded-full 
                            @if($booking->isDiproses()) bg-yellow-500
                            @elseif($booking->isDisetujui()) bg-green-500
                            @else bg-red-500 @endif
                            flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-12">
                            <h3 class="font-medium">{{ $statusBooking['text'] }}</h3>
                            <p class="text-sm text-gray-600">{{ $booking->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>

                    <!-- Rental Status (if approved) -->
                    @if($booking->isDisetujui())
                        <div class="flex items-center">
                            <div class="absolute left-0 w-8 h-8 rounded-full 
                                @if($booking->isBelumDisewa()) bg-gray-500
                                @elseif($booking->isDisewa()) bg-blue-500
                                @else bg-green-500 @endif
                                flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-12">
                                <h3 class="font-medium">{{ $statusSewa['text'] }}</h3>
                                <p class="text-sm text-gray-600">{{ $booking->updated_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
