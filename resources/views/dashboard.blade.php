@extends('layouts.app')
@section('title', 'Dashboard - BonsaRental')

@section('content')
<div class="pt-20">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl p-6 mb-8 text-white shadow-lg">
        <h1 class="text-2xl font-bold">Selamat datang, {{ request()->query('username') ?: 'Guest' }}!</h1>
        <p class="mt-2">Temukan berbagai perlengkapan fotografi berkualitas untuk kebutuhan anda.</p>
    </div>

    <!-- Featured Equipment -->
    <div class="mb-12">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Featured Equipment</h2>
            <a href="{{ route('pengelolaan') }}" class="text-purple-600 hover:underline">View All</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Featured Item 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('assets/camera1.jpg') }}" alt="Canon EOS R5" class="w-full h-48 object-cover">
                <div class="p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-lg">Canon EOS R5</h3>
                            <p class="text-gray-600 text-sm">45MP Full-Frame Mirrorless Camera</p>
                        </div>
                        <span class="bg-purple-100 text-purple-800 text-xs font-semibold py-1 px-2 rounded">Camera</span>
                    </div>
                    <p class="text-purple-600 font-bold mt-2">Rp 150.000/hari</p>
                    <button class="mt-4 w-full bg-purple-600 hover:bg-purple-700 text-white py-2 rounded-lg transition">Rental Now</button>
                </div>
            </div>

            <!-- Featured Item 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('assets/lens1.jpg') }}" alt="Canon RF 24-70mm f/2.8L" class="w-full h-48 object-cover">
                <div class="p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-lg">Canon RF 24-70mm f/2.8L</h3>
                            <p class="text-gray-600 text-sm">Professional Standard Zoom Lens</p>
                        </div>
