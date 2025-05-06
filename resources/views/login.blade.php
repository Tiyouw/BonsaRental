@extends('layouts.app')

@section('title', 'Login - BonsaRental')

@section('content')
<div class="flex flex-col lg:flex-row min-h-screen">
    <div class="w-full lg:w-1/2 bg-primary p-8 lg:p-16 flex items-center">
        <div>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Sewa perlengkapan fotografi dengan mudah</h1>
            <p class="text-xl text-white mb-8">Kami menyediakan segala kebutuhan yang anda butuhkan.</p>
            <a href="{{ route('login') }}" class="bg-white text-primary hover:bg-light px-8 py-3 rounded-md text-lg font-medium">Daftar Sekarang!</a>
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
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
            <div class="text-center mb-8">
                <h3 class="text-2xl font-bold mb-2">bonsarental</h3>
                <h2 class="text-3xl font-semibold">Masuk</h2>
            </div>
            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="mb-6">
                    <label for="username" class="block text-gray-700 mb-2">Username</label>
                    <input type="text" id="username" name="username" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 mb-2">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                </div>
                <button type="submit" class="w-full py-3 bg-primary text-white font-medium rounded-md hover:bg-secondary transition-colors">Masuk</button>
            </form>
            <p class="text-center mt-6">New to BonsaRental? <a href="#" class="text-primary hover:underline">Daftar</a></p>
        </div>
    </div>
</div>
@endsection
