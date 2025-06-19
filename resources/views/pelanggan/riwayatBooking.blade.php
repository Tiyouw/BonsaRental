@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Riwayat Booking</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($bookings->isEmpty())
        <div class="bg-white rounded-lg shadow-lg p-6 text-center">
            <p class="text-gray-600">Anda belum memiliki riwayat booking.</p>
        </div>
    @else
        <div class="grid grid-cols-1 gap-6">
            @foreach($bookings as $booking)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h2 class="text-xl font-semibold">Booking #{{ $booking->id_booking }}</h2>
                                <p class="text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y H:i') }}
                                </p>
                            </div>
                            <div class="flex flex-col items-end space-y-2">
                                @php $statusBooking = $booking->getStatusBookingLabel(); @endphp
                                <span class="px-2 py-1 rounded text-sm
                                    bg-{{ $statusBooking['color'] }}-100 text-{{ $statusBooking['color'] }}-800">
                                    Status Booking: {{ $statusBooking['text'] }}
                                </span>
                                @if($booking->isDisetujui())
                                    @php $statusSewa = $booking->getStatusSewaLabel(); @endphp
                                    <span class="px-2 py-1 rounded text-sm
                                        bg-{{ $statusSewa['color'] }}-100 text-{{ $statusSewa['color'] }}-800">
                                        Status Sewa: {{ $statusSewa['text'] }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-gray-600">Tanggal Booking:</p>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Tanggal Kembali:</p>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($booking->tanggal_kembali)->format('d M Y') }}</p>
                            </div>
                        </div>

                        <div class="border-t pt-4">
                            <h3 class="font-semibold mb-2">Produk yang Dibooking:</h3>
                            <div class="space-y-4">
                                @foreach($booking->detailBookings as $detail)
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            @if($detail->produk->gambar)
                                                <img src="{{ asset('storage/' . $detail->produk->gambar) }}"
                                                     alt="{{ $detail->produk->nama_produk }}"
                                                     class="w-12 h-12 object-cover rounded mr-3">
                                            @endif
                                            <div>
                                                <p class="font-medium">{{ $detail->produk->nama_produk }}</p>
                                                <p class="text-sm text-gray-600">{{ $detail->jumlah }} unit</p>
                                            </div>
                                        </div>
                                        <p class="font-medium">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4 pt-4 border-t flex justify-between">
                                <span class="font-semibold">Total:</span>
                                <span class="font-bold">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        @if($booking->bukti_pembayaran)
                            <div class="mt-4 pt-4 border-t">
                                <h3 class="font-semibold mb-2">Bukti Pembayaran:</h3>
                                <img src="{{ asset('storage/' . $booking->bukti_pembayaran) }}"
                                     alt="Bukti Pembayaran"
                                     class="max-w-xs rounded shadow">
                            </div>
                        @endif

                        <div class="mt-4 flex justify-end">
                            <a href="{{ route('booking.show', $booking->id_booking) }}"
                               class="text-blue-600 hover:text-blue-800">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
