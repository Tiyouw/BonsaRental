@extends('layouts.app')

@section('title', 'Daftar Pelanggan - BonsaRental')

@section('content')
<div class="container mx-auto px-4 py-8"> {{-- Removed redundant layout wrappers --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Pelanggan</h1>
    </div>

    {{-- Search and Sort Filter --}}
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <form action="{{ route('admin.customers.index') }}" method="GET" class="flex flex-col md:flex-row md:items-end gap-4">
            <div class="flex-grow">
                <label for="search" class="block text-gray-700 text-sm font-bold mb-2">Cari Pelanggan:</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       placeholder="Cari berdasarkan username, nama, atau no. HP...">
            </div>

            <div>
                <label for="sort_by" class="block text-gray-700 text-sm font-bold mb-2">Urutkan Berdasarkan:</label>
                <select name="sort_by" id="sort_by" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="created_at" @selected(request('sort_by', 'created_at') == 'created_at')>Tanggal Registrasi</option>
                    <option value="username" @selected(request('sort_by') == 'username')>Username</option>
                    <option value="nama_lengkap" @selected(request('sort_by') == 'nama_lengkap')>Nama Lengkap</option>
                    <option value="no_hp" @selected(request('sort_by') == 'no_hp')>Nomor HP</option>
                </select>
            </div>

            <div>
                <label for="sort_order" class="block text-gray-700 text-sm font-bold mb-2">Urutan:</label>
                <select name="sort_order" id="sort_order" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="desc" @selected(request('sort_order', 'desc') == 'desc')>Terbaru/Terbesar</option>
                    <option value="asc" @selected(request('sort_order') == 'asc')>Terlama/Terkecil</option>
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-primary hover:bg-primary/80 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Terapkan
                </button>
                <a href="{{ route('admin.customers.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Username
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nama Lengkap
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nomor HP
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal Registrasi
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($customers as $customer)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $customer->username }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $customer->nama_lengkap }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $customer->no_hp }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($customer->created_at)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.customers.show', $customer->id) }}"
                               class="text-blue-600 hover:text-blue-900 mr-3">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada data pelanggan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination Links --}}
    <div class="mt-4">
        {{ $customers->appends(request()->except('page'))->links() }}
    </div>
</div>
@endsection
