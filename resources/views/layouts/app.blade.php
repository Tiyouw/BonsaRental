<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BonsaRental - Sewa Perlengkapan Fotografi')</title>
    @vite('resources/css/app.css')
    <style>
        @layer utilities {
            .content-area {
                min-height: calc(100vh - 64px);
            }
        }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-gradient-to-br from-gray-50 to-light">

    {{-- Navbar --}}
    <nav class="fixed top-0 left-0 right-0 z-50 bg-primary/80 backdrop-blur-md border-b border-white/10 shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('landing') }}" class="flex items-center">
                    <img src="{{ asset('images/bonsa-logo.png') }}" alt="Bonsa Rental" class="h-8 w-auto">
                </a>

                <div class="md:hidden">
                    <button type="button" class="text-black hover:text-light focus:outline-none" id="mobile-menu-button">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                <div class="hidden md:flex md:items-center">
                    @if(request()->routeIs('landing'))
                        <div class="relative group">
                            <a href="{{ route('login') }}" class="text-black hover:text-light px-3 py-2 mx-2">Masuk</a>
                            <a href="{{ route('register') }}" class="bg-white text-primary hover:bg-light px-3 py-2 rounded-md ml-2">Daftar</a>
                        </div>
                    @else
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="text-black hover:text-light px-3 py-2 mx-2">Dashboard</a>
                                <a href="{{ route('pengelolaan.index') }}" class="text-black hover:text-light px-3 py-2 mx-2">Pengelolaan</a>
                                <a href="{{ route('admin.profile') }}" class="text-black hover:text-light px-3 py-2 mx-2">Profil</a>
                            @else
                                <a href="{{ route('dashboardPelanggan') }}" class="text-black hover:text-light px-3 py-2 mx-2">Dashboard</a>
                                <a href="{{ route('katalog') }}" class="text-black hover:text-light px-3 py-2 mx-2">Katalog</a>
                                <a href="{{ route('riwayatBooking') }}" class="text-black hover:text-light px-3 py-2 mx-2">Riwayat</a>
                                <a href="{{ route('profilePelanggan') }}" class="text-black hover:text-light px-3 py-2 mx-2">Profil</a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-black hover:text-light px-3 py-2 mx-2">Logout</button>
                            </form>
                        @endauth
                    @endif
                </div>
            </div>
        </div>

        <div class="hidden md:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-primary/90 backdrop-blur-md">
                <div class="px-3 py-2 text-white font-medium">Katalog</div>
                <a href="#" class="block px-3 py-2 ml-4 text-white hover:bg-primary/50 rounded-md">Kamera</a>
                <a href="#" class="block px-3 py-2 ml-4 text-white hover:bg-primary/50 rounded-md">Lensa</a>
                <a href="#" class="block px-3 py-2 ml-4 text-white hover:bg-primary/50 rounded-md">Lighting</a>
                <a href="#" class="block px-3 py-2 ml-4 text-white hover:bg-primary/50 rounded-md">Aksesoris</a>

                @if(request()->routeIs('landing'))
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-white hover:bg-primary/50 rounded-md">Masuk</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 text-white hover:bg-primary/50 rounded-md">Daftar</a>
                @else
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-white hover:bg-primary/50 rounded-md">Dashboard</a>
                            <a href="{{ route('pengelolaan.index') }}" class="block px-3 py-2 text-white hover:bg-primary/50 rounded-md">Pengelolaan</a>
                            <a href="{{ route('admin.profile') }}" class="block px-3 py-2 text-white hover:bg-primary/50 rounded-md">Profil</a>
                        @else
                            <a href="{{ route('dashboardPelanggan') }}" class="block px-3 py-2 text-white hover:bg-primary/50 rounded-md">Dashboard</a>
                            <a href="{{ route('katalog') }}" class="block px-3 py-2 text-white hover:bg-primary/50 rounded-md">Katalog</a>
                            <a href="{{ route('riwayatBooking') }}" class="block px-3 py-2 text-white hover:bg-primary/50 rounded-md">Riwayat</a>
                            <a href="{{ route('profilePelanggan') }}" class="block px-3 py-2 text-white hover:bg-primary/50 rounded-md">Profil</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="block w-full text-left px-3 py-2 text-white hover:bg-primary/50 rounded-md">Logout</button>
                        </form>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    {{-- Konten Utama --}}
    <div class="flex-1 pt-16">
        @yield('content')
    </div>

    {{-- Footer --}}
    <x-footer />

    {{-- Script Toggle Menu Mobile --}}
    <script>
        document.getElementById('mobile-menu-button')?.addEventListener('click', function () {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

    @yield('scripts')
</body>
</html>
