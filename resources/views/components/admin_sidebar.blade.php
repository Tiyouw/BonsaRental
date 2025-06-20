{{-- resources/views/components/admin-sidebar.blade.php --}}

{{-- Sisi bilah navigasi (sidebar) Admin --}}
<div class="hidden md:block w-64 bg-dark min-h-screen fixed">
    <div class="flex flex-col">
        {{-- Dashboard Link --}}
        <a href="{{ route('admin.dashboard') }}" class="flex items-center text-white px-4 py-4
            @if(Request::routeIs('admin.dashboard')) bg-primary @else hover:bg-primary/50 @endif">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span>Dashboard</span>
        </a>
        {{-- Pengelolaan Link --}}
        <a href="{{ route('pengelolaan.index') }}" class="flex items-center text-white px-4 py-4
            @if(Request::routeIs('pengelolaan.index') || Request::routeIs('pengelolaan.create') || Request::routeIs('pengelolaan.edit') || Request::routeIs('pengelolaan.show')) bg-primary @else hover:bg-primary/50 @endif">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            <span>Pengelolaan</span>
        </a>
        {{-- Riwayat Link --}}
        <a href="{{ route('admin.bookings.index') }}" class="flex items-center text-white px-4 py-4
            @if(Request::routeIs('admin.bookings.*') || Request::routeIs('admin.riwayatAdmin')) bg-primary @else hover:bg-primary/50 @endif">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>Riwayat</span>
        </a>
        {{-- Pelanggan Link (NEW) --}}
        <a href="{{ route('admin.customers.index') }}" class="flex items-center text-white px-4 py-4
            @if(Request::routeIs('admin.customers.*')) bg-primary @else hover:bg-primary/50 @endif">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H2v-2a3 3 0 015.356-1.857M17 20v-2c0-.653-.162-1.282-.47-1.857M2 12v-2c0-.653.162-1.282.47-1.857m0 0a2 2 0 11-4 0 2 2 0 014 0zM12 11a2 2 0 100-4 2 2 0 000 4z"></path>
            </svg>
            <span>Pelanggan</span>
        </a>
        {{-- Profile Link --}}
        <a href="{{ route('admin.profile') }}" class="flex items-center text-white px-4 py-4
            @if(Request::routeIs('admin.profile') || Request::routeIs('admin.profile.edit') || Request::routeIs('admin.profile.update')) bg-primary @else hover:bg-primary/50 @endif">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <span>Profile</span>
        </a>
    </div>
</div>
