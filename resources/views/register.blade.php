@extends('layouts.app')

@section('title', 'Register - BonsaRental')

@section('content')
<div class="flex flex-col lg:flex-row min-h-screen">
    <div class="w-full lg:w-1/2 bg-primary p-8 lg:p-16 flex items-center">
        <div>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Sewa perlengkapan fotografi dengan mudah</h1>
            <p class="text-xl text-white mb-8">Kami menyediakan segala kebutuhan yang anda butuhkan.</p>
            <a href="{{ route('login') }}" class="bg-white text-primary hover:bg-light px-8 py-3 rounded-md text-lg font-medium">Login Sekarang!</a>
        </div>
    </div>
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
            <div class="text-center mb-8">
                <h3 class="text-2xl font-bold mb-2">bonsarental</h3>
                <h2 class="text-3xl font-semibold">Daftar</h2>
            </div>
            <form method="POST" action="{{ route('register.submit') }}">
                @csrf
                <div class="mb-6">
                    <label for="username" class="block text-gray-700 mb-2">Username</label>
                    <input type="text" id="username" name="username" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" value="{{ old('username') }}" required>
                    @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" value="{{ old('email') }}" required>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 mb-2">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="w-full py-3 bg-primary text-white font-medium rounded-md hover:bg-secondary transition-colors">Daftar</button>
            </form>
            <p class="text-center mt-6">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary hover:underline">Login</a></p>
        </div>
    </div>
</div>
@endsection
