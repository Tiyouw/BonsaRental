@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8"> {{-- Removed redundant layout wrappers --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Booking</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID Booking
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Pelanggan
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal Booking
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status Booking
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status Sewa
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Total
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($bookings as $booking)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            #{{ $booking->id_booking }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $booking->user->nama_lengkap }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php $statusBooking = $booking->getStatusBookingLabel(); @endphp
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                bg-{{ $statusBooking['color'] }}-100 text-{{ $statusBooking['color'] }}-800">
                                {{ $statusBooking['text'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php $statusSewa = $booking->getStatusSewaLabel(); @endphp
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                bg-{{ $statusSewa['color'] }}-100 text-{{ $statusSewa['color'] }}-800">
                                {{ $statusSewa['text'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex flex-col space-y-2">
                                <a href="{{ route('admin.bookings.show', $booking->id_booking) }}"
                                   class="text-blue-600 hover:text-blue-900">Detail</a>

                                @if($booking->isDiproses())
                                    <form action="{{ route('admin.bookings.update-status-booking', $booking->id_booking) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status_booking" value="disetujui">
                                        <button type="submit"
                                                class="text-green-600 hover:text-green-900"
                                                onclick="return confirm('Apakah Anda yakin ingin menyetujui booking ini?')">
                                            Setujui Booking
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.bookings.update-status-booking', $booking->id_booking) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status_booking" value="ditolak">
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Apakah Anda yakin ingin menolak booking ini?')">
                                            Tolak Booking
                                        </button>
                                    </form>
                                @endif

                                @if($booking->isDisetujui() && $booking->isBelumDisewa())
                                    <form action="{{ route('admin.bookings.update-status-sewa', $booking->id_booking) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status_sewa" value="disewa">
                                        <button type="submit"
                                                class="text-blue-600 hover:text-blue-900"
                                                onclick="return confirm('Konfirmasi barang telah diambil oleh pelanggan?')">
                                            Konfirmasi Pengambilan
                                        </button>
                                    </form>
                                @endif

                                @if($booking->isDisetujui() && $booking->isDisewa())
                                    <form action="{{ route('admin.bookings.update-status-sewa', $booking->id_booking) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status_sewa" value="dikembalikan">
                                        <button type="submit"
                                                class="text-green-600 hover:text-green-900"
                                                onclick="return confirm('Konfirmasi barang telah dikembalikan?')">
                                            Konfirmasi Pengembalian
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.bookings.destroy', $booking->id_booking) }}"
                                      method="POST"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-gray-600 hover:text-gray-900"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus booking ini? Tindakan ini tidak dapat dibatalkan.')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada data booking
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
