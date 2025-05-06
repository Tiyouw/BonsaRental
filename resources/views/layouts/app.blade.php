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
    <!-- Navbar Component -->
    <x-navbar />

    <!-- Main Content -->
    <div class="flex-1 pt-16">
        @yield('content')
    </div>   <div class="flex flex-1 pt-16"> <!-- This pt-16 creates space for the navbar -->
        <!-- Sidebar (if present) -->
        @if(request()->routeIs('dashboard') || request()->routeIs('pengelolaan') || request()->routeIs('profile'))
            <div class="hidden md:block w-64 bg-dark min-h-screen fixed">
                <!-- Sidebar content -->
                <div class="flex flex-col">
                    <!-- Your sidebar items -->
                </div>
            </div>
            <!-- Main content with sidebar offset -->
            <div class="w-full md:ml-64 p-4">
                @yield('content')
            </div>
        @else
            <!-- Main content without sidebar -->
            <div class="w-full p-4">
                @yield('content')
            </div>
        @endif
    </div>

    <!-- Footer Component -->
    <x-footer />

    @yield('scripts')
</body>
</html>
