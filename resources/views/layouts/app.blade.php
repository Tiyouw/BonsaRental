<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BonsaRental - Sewa Perlengkapan Fotografi')</title>
    <link rel="icon" href="{{ asset('images/Logogram_BonsaRental_Purple.svg') }}" type="image/svg+xml" >

    @vite('resources/css/app.css')
    <style>
        /* General styling for the body to enable flex for sidebar/content or just default stacking */
        body {
            /* Ensures flex container for full height, or pushes content down if navbar is present */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Adjustments for content area when navbar is present */
        .content-with-navbar {
            padding-top: 64px; /* Adjust this based on your navbar's fixed height */
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-light">

    @auth
        {{-- If user is logged in --}}
        @if(Auth::user()->isAdmin())
            {{-- Admin Layout: Sidebar + main content with margin-left --}}
            <div class="flex flex-1"> {{-- flex-1 ensures this div takes available space below the header --}}
                <x-admin_sidebar />
                <div class="w-full md:ml-64"> {{-- Adjust ml-64 based on your sidebar's width --}}
                    @yield('content')
                </div>
            </div>
        @else
            {{-- Customer Layout: Navbar at top, content below --}}
            <x-navbar />
            <div class="flex-1 content-with-navbar"> {{-- Pushes content down below fixed navbar --}}
                @yield('content')
            </div>
        @endif
    @else
        {{-- Guest Layout: Navbar at top, content below --}}
        <x-navbar />
        <div class="flex-1 content-with-navbar"> {{-- Pushes content down below fixed navbar --}}
            @yield('content')
        </div>
    @endauth

    {{-- Footer --}}
    <x-footer />

    @yield('scripts')
</body>
</html>
