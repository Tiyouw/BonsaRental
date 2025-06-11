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
        <img src="https://images.unsplash.com/photo-1452780212940-6f5c0d14d848?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80" alt="Camera Gear" class="w-full h-full object-cover">
    </div>
</div>

<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-4xl font-bold text-center text-primary mb-12">Mengapa Memilih Kami?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-gray-800">
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Kualitas Terjamin</h3>
                <p class="text-gray-600">Semua perlengkapan kami terawat dengan baik dan siap digunakan.</p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-md text-center">
                <div class="flex justify-center mb-4">
                    <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Proses Mudah & Cepat</h3>
                <p class="text-gray-600">Sewa perlengkapan hanya dalam beberapa langkah mudah secara online.</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-primary mb-8">Siap Memulai Petualangan Fotografi Anda?</h2>
        <p class="text-xl text-gray-700 mb-8">Jelajahi katalog kami sekarang dan temukan perlengkapan yang Anda butuhkan!</p>
        <a href="{{ route('register') }}" class="bg-primary text-white px-8 py-4 rounded-md text-lg font-medium hover:bg-secondary transition-colors">Daftar & Jelajahi</a>
    </div>
</div>
@endsection
