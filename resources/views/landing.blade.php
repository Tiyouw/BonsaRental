@extends('layouts.app')

@section('title', 'BonsaRental - Sewa Perlengkapan Fotografi')

@section('content')
<div class="flex flex-col lg:flex-row">
    <div class="w-full lg:w-1/2 bg-primary p-8 lg:p-16 flex items-center" style="min-height: 500px;">
        <div>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Sewa perlengkapan fotografi dengan mudah</h1>
            <p class="text-xl text-white mb-8">Kami menyediakan segala kebutuhan yang anda butuhkan.</p>
            <a href="{{ route('login') }}" class="bg-white text-primary hover:bg-light px-8 py-3 rounded-md text-lg font-medium">Masuk Sekarang!</a>
            <div class="mt-12">
                <div class="flex items-center">
                    <div class="mr-4">
                        <span class="text-white font-bold">01</span>
                    </div>
                    <div class="w-full h-0.5 bg-white/30 relative">
                        <div class="absolute left-0 top-0 w-1/4 h-0.5 bg-white"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full lg:w-1/2">
        <img src="https://images.unsplash.com/photo-1452780212940-6f5c0d14d848?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1476&q=80" alt="Camera" class="w-full h-full object-cover" style="max-height: 500px;">
    </div>
</div>

<div class="container mx-auto py-16 px-4">
    <h2 class="text-3xl font-bold text-center mb-12">Kategori Perlengkapan</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1964&q=80" alt="Kamera" class="w-full h-48 object-cover">
            <div class="p-6 text-center">
                <h3 class="text-xl font-semibold mb-2">Kamera</h3>
                <p class="text-gray-600 mb-4">Berbagai pilihan kamera DSLR dan mirrorless untuk kebutuhan fotografi Anda.</p>
                <a href="#" class="btn-primary inline-block">Lihat Semua</a>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="https://images.unsplash.com/photo-1552830710-b3ad75beca12?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Lensa" class="w-full h-48 object-cover">
            <div class="p-6 text-center">
                <h3 class="text-xl font-semibold mb-2">Lensa</h3>
                <p class="text-gray-600 mb-4">Lensa berkualitas tinggi untuk berbagai jenis kebutuhan fotografi.</p>
                <a href="#" class="btn-primary inline-block">Lihat Semua</a>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="https://images.unsplash.com/photo-1745848038063-bbb6fc8c8867?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Lighting" class="w-full h-48 object-cover">
            <div class="p-6 text-center">
                <h3 class="text-xl font-semibold mb-2">Lighting</h3>
                <p class="text-gray-600 mb-4">Peralatan lighting untuk menghasilkan foto dengan pencahayaan sempurna.</p>
                <a href="#" class="btn-primary inline-block">Lihat Semua</a>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="https://images.unsplash.com/photo-1593935308260-d47509d56370?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fGFjY2Vzc29yaWVzJTIwY2FtZXJhfGVufDB8fDB8fHww" alt="Aksesoris" class="w-full h-48 object-cover">
            <div class="p-6 text-center">
                <h3 class="text-xl font-semibold mb-2">Aksesoris</h3>
                <p class="text-gray-600 mb-4">Berbagai aksesoris pendukung untuk melengkapi kebutuhan fotografi Anda.</p>
                <a href="#" class="btn-primary inline-block">Lihat Semua</a>
            </div>
        </div>
    </div>
</div>

<div class="bg-gray-100 py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Mengapa Memilih BonsaRental?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-lg shadow-md text-center">
                <div class="flex justify-center mb-4">
                    <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Peralatan Berkualitas</h3>
                <p class="text-gray-600">Semua peralatan kami terjamin kualitasnya dan selalu dalam kondisi prima.</p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-md text-center">
                <div class="flex justify-center mb-4">
                    <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Harga Terjangkau</h3>
                <p class="text-gray-600">Dapatkan peralatan fotografi berkualitas dengan harga yang bersahabat.</p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-md text-center">
                <div class="flex justify-center mb-4">
                    <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Layanan 24/7</h3>
                <p class="text-gray-600">Tim dukungan kami siap membantu Anda kapan saja dan di mana saja.</p>
            </div>
        </div>
    </div>
</div>
@endsection
