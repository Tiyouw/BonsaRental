{{-- resources/views/components/navbar.blade.php --}}
{{-- This component is designed to be included in layouts.app for guest and customer users --}}

<nav class="fixed top-0 left-0 right-0 z-50 bg-primary/80 backdrop-blur-md border-b border-white/10 shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <a href="{{ auth()->check() ? (auth()->user()->isAdmin() ? route('admin.dashboard') : route('katalog')) : route('landing') }}" class="flex items-center">
                <img src="{{ asset('images/bonsa-logo.png') }}" alt="Bonsa Rental" class="h-8 w-auto">
            </a>

            <div class="md:hidden">
                <button type="button" class="text-black hover:text-light focus:outline-none" id="mobile-menu-button">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <div class="hidden md:flex md:items-center">
                @guest
                    <div class="relative group">
                        <a href="{{ route('login') }}" class="text-black hover:text-light px-3 py-2 mx-2">Masuk</a>
                        <a href="{{ route('register')}}" class="bg-white text-primary hover:bg-light px-3 py-2 rounded-md ml-2">Daftar</a>
                    </div>
                @else {{-- User is authenticated --}}
                    {{-- Customer Specific Links --}}
                    @if(auth()->user()->isCustomer())
                        <a href="{{ route('katalog') }}" class="text-black hover:text-light px-3 py-2 mx-2">Beranda</a>
                        <a href="{{ route('riwayatBooking') }}" class="text-black hover:text-light px-3 py-2 mx-2">Riwayat</a>
                        <a href="{{ route('profilePelanggan') }}" class="text-black hover:text-light px-3 py-2 mx-2">Profil</a>
                    @endif
                    {{-- Logout is common for both authenticated roles, but Admin uses sidebar --}}
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-black hover:text-light px-3 py-2 mx-2">Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div class="hidden md:hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 bg-primary/90 backdrop-blur-md">
            @guest
                <a href="{{ route('login') }}" class="block px-3 py-2 text-white hover:bg-primary/50 rounded-md">Masuk</a>
                <a href="{{ route('register') }}" class="block px-3 py-2 text-white hover:bg-primary/50 rounded-md">Daftar</a>
            @else {{-- User is authenticated --}}
                {{-- Customer Specific Links for Mobile --}}
                @if(auth()->user()->isCustomer())
                    <a href="{{ route('katalog') }}" class="block px-3 py-2 text-white hover:bg-primary/50 rounded-md">Beranda</a>
                    <a href="{{ route('riwayatBooking') }}" class="block px-3 py-2 text-white hover:bg-primary/50 rounded-md">Riwayat</a>
                    <a href="{{ route('profilePelanggan') }}" class="block px-3 py-2 text-white hover:bg-primary/50 rounded-md">Profil</a>
                @endif
                {{-- Logout for Mobile, common for both authenticated roles if they use this navbar --}}
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="block w-full text-left px-3 py-2 text-white hover:bg-primary/50 rounded-md">Logout</button>
                </form>
            @endguest
        </div>
    </div>
</nav>

<script>
    // Script to toggle mobile menu visibility
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>
