@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 mt-16">
    <!-- Category Tabs -->
    <div class="mb-8 border-b border-gray-200">
        <div class="flex space-x-8">
            @foreach($categories as $cat)
                <button 
                    onclick="changeCategory('{{ $cat->id_kategori }}')"
                    class="category-tab py-4 px-1 border-b-2 font-medium text-sm {{ $category->id_kategori == $cat->id_kategori ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}"
                >
                    {{ $cat->nama_kategori }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img 
                    src="{{ asset('storage/' . $product->gambar) }}" 
                    alt="{{ $product->nama_produk }}"
                    class="w-full h-48 object-cover"
                >
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">{{ $product->nama_produk }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ $product->deskripsi }}</p>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-blue-600 font-bold">
                            Rp {{ number_format($product->harga_per_hari, 0, ',', '.') }}/hari
                        </span>
                        <span class="text-sm text-gray-500">
                            Stok: {{ $product->stock }}
                        </span>
                    </div>
                    @if($product->stock > 0)
                        <a 
                            href="{{ route('booking.form', $product->id_produk) }}" 
                            class="block w-full text-center bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors"
                        >
                            Booking Sekarang
                        </a>
                    @else
                        <button 
                            class="block w-full bg-gray-300 text-gray-500 py-2 px-4 rounded-md cursor-not-allowed"
                            disabled
                        >
                            Stok Habis
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500">Tidak ada produk tersedia untuk kategori ini.</p>
            </div>
        @endforelse
    </div>
</div>

<script>
function changeCategory(categoryId) {
    window.location.href = `{{ route('katalog') }}?category=${categoryId}`;
}
</script>
@endsection
