<nav class="fixed top-0 left-0 right-0 z-50 bg-primary/80 backdrop-blur-md border-b border-white/10 shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <a href="{{ route('landing') }}" class="flex items-center">
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
                @if(request()->routeIs('landing'))
                    <div class="relative group">
                        <a href="{{ route('login') }}" class="text-black hover:text-light px-3 py-2 mx-2">Masuk</a>
                        <a href="{{ route('register')}}" class="bg-white text-primary hover:bg-light px-3 py-2 rounded-md ml-2">Daftar</a>
                    </div>
                @else
                    <a href="{{ route('dashboardPelanggan') }}" class="text-black hover:text-light px-3 py-2 mx-2">Beranda</a>
                    <a href="{{ route('riwayatBooking') }}" class="text-black hover:text-light px-3 py-2 mx-2">Riwayat</a>
                    <a href="{{ route('profilePelanggan') }}" class="text-black hover:text-light px-3 py-2 mx-2">Profil</a>
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
                <a href="#" class="block px-3 py-2 text-white hover:bg-primary/50 rounded-md">Daftar</a>
            @else
                <a href="{{ route('dashboardPelanggan') }}" class="text-black hover:text-light px-3 py-2 mx-2">Beranda</a>
                <a href="{{ route('riwayatBooking') }}" class="text-black hover:text-light px-3 py-2 mx-2">Riwayat</a>
                <a href="{{ route('profilePelanggan') }}" class="text-black hover:text-light px-3 py-2 mx-2">Profil</a>
            @endif
        </div>
    </div>
</nav>

<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
