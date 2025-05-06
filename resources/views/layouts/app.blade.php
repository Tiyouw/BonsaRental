<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">
    <title>@yield('title', 'Bonsa Rental')</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-KyZXEAg3QhqLMpG8r+Knujsl5+RrF0Ky8rW2XvYoE6iOr3YoD1p5Rf4mMHbh4vW4lJhJmD2a5XWm4GR8+2o4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100">
    <x-navbar></x-navbar>

    <main class="container mx-auto py-4 px-4">
        @yield('content')
    </main>

    <x-footer></x-footer>
</body>
</html>
