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
    <x-navbar />
    <div class="flex-1 pt-16">
        @yield('content')
    </div>
    <x-footer />

    @yield('scripts')
</body>
</html>
