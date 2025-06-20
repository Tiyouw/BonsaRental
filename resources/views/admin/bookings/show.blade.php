@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8"> {{-- Removed redundant layout wrappers --}}
    <div class="mb-6">
        <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center text-gray-700 hover:text-gray-900">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M15 18l-6-6 6-6"></path>
            </svg>
            Kembali ke Daftar Booking
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-2xl font-bold mb-2">Detail Booking #{{ $booking->id_booking }}</h1>
                    <p class="text-gray-600">Dibuat pada: {{ $booking->created_at->format('d M Y H:i') }}</p>
                </div>
                <div class="flex flex-col items-end space-y-2">
                    @php $statusBooking = $booking->getStatusBookingLabel(); @endphp
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        bg-{{ $statusBooking['color'] }}-100 text-{{ $statusBooking['color'] }}-800">
                        Status Booking: {{ $statusBooking['text'] }}
                    </span>
                    @php $statusSewa = $booking->getStatusSewaLabel(); @endphp
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        bg-{{ $statusSewa['color'] }}-100 text-{{ $statusSewa['color'] }}-800">
                        Status Sewa: {{ $statusSewa['text'] }}
                    </span>
                </div>
            </div>

            <!-- Informasi Pelanggan -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold mb-3">Informasi Pelanggan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600">Nama</p>
                        <p class="font-medium">{{ $booking->user->nama_lengkap }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Email</p>
                        <p class="font-medium">{{ $booking->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">No. HP</p>
                        <p class="font-medium">{{ $booking->user->no_hp }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Alamat</p>
                        <p class="font-medium">{{ $booking->user->alamat }}</p>
                    </div>
                </div>
            </div>

            <!-- Detail Peminjaman -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold mb-3">Detail Peminjaman</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600">Tanggal Booking</p>
                        <p class="font-medium">{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Tanggal Kembali</p>
                        <p class="font-medium">{{ \Carbon\Carbon::parse($booking->tanggal_kembali)->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Produk yang Dibooking -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold mb-3">Produk yang Dibooking</h2>
                <div class="border rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($booking->detailBookings as $detail)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if($detail->produk->gambar)
                                                <img src="{{ asset('storage/' . $detail->produk->gambar) }}"
                                                     alt="{{ $detail->produk->nama_produk }}"
                                                     class="w-12 h-12 object-cover rounded mr-3">
                                            @else
                                                <img src="https://placehold.co/48x48/CCCCCC/333333?text=No+Image"
                                                     alt="No Image"
                                                     class="w-12 h-12 object-cover rounded mr-3">
                                            @endif
                                            <div>
                                                <p class="font-medium">{{ $detail->produk->nama_produk }}</p>
                                                <p class="text-sm text-gray-500">
                                                    Rp {{ number_format($detail->produk->harga_per_hari, 0, ',', '.') }}/hari
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">{{ $detail->jumlah }}</td>
                                    <td class="px-6 py-4">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="2" class="px-6 py-4 text-right font-medium">Total:</td>
                                <td class="px-6 py-4 font-bold">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Bukti Pembayaran -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold mb-3">Bukti Pembayaran</h2>
                @if($booking->bukti_pembayaran)
                    <div class="flex flex-col items-start space-y-4">
                        <img src="{{ asset('storage/' . $booking->bukti_pembayaran) }}"
                             alt="Bukti Pembayaran"
                             class="max-w-xs md:max-w-md rounded shadow-lg object-contain">
                        <a href="{{ asset('storage/' . $booking->bukti_pembayaran) }}"
                           download="{{ 'bukti_pembayaran_' . $booking->id_booking . '.' . pathinfo($booking->bukti_pembayaran, PATHINFO_EXTENSION) }}"
                           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Unduh Bukti Pembayaran
                        </a>
                    </div>
                @else
                    <p class="text-gray-600">Bukti pembayaran belum diunggah.</p>
                @endif
            </div>

            <!-- Aksi -->
            <div class="flex flex-wrap justify-end gap-4">
                @if($booking->isDiproses())
                    <form action="{{ route('admin.bookings.update-status-booking', $booking->id_booking) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_booking" value="disetujui">
                        <button type="submit"
                                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
                                onclick="return confirm('Apakah Anda yakin ingin menyetujui booking ini?')">
                            Setujui Booking
                        </button>
                    </form>

                    <form action="{{ route('admin.bookings.update-status-booking', $booking->id_booking) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_booking" value="ditolak">
                        <button type="submit"
                                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                                onclick="return confirm('Apakah Anda yakin ingin menolak booking ini?')">
                            Tolak Booking
                        </button>
                    </form>
                @endif

                @if($booking->isDisetujui() && $booking->isBelumDisewa())
                    <form action="{{ route('admin.bookings.update-status-sewa', $booking->id_booking) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_sewa" value="disewa">
                        <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                                onclick="return confirm('Konfirmasi barang telah diambil oleh pelanggan?')">
                            Konfirmasi Pengambilan
                        </button>
                    </form>
                @endif

                @if($booking->isDisetujui() && $booking->isDisewa())
                    <form action="{{ route('admin.bookings.update-status-sewa', $booking->id_booking) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_sewa" value="dikembalikan">
                        <button type="submit"
                                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
                                onclick="return confirm('Konfirmasi barang telah dikembalikan?')">
                            Konfirmasi Pengembalian
                        </button>
                    </form>
                @endif
                <form action="{{ route('admin.bookings.destroy', $booking->id_booking) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus booking ini? Tindakan ini tidak dapat dibatalkan.')">
                        Hapus Booking
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
