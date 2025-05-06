<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">
    <title>Login - BonsaRental</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-gray-100">
    <div class="min-h-screen flex">
        <div class="hidden md:block w-1/2 bg-cover bg-center" style="background-image: url('{{ asset('assets/camera-bg.jpg') }}')">
        </div>
        <div class="w-full md:w-1/2 flex items-center justify-center p-8">
            <div class="max-w-md w-full">
                <div class="text-center mb-10">
                    <h1 class="text-3xl font-bold text-purple-600">BonsaRental</h1>
                    <p class="text-gray-500 mt-2">Login to your account</p>
                </div>

                <div class="bg-white rounded-lg p-8 shadow-md">
                    <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Username</label>
                            <input type="text" name="username" placeholder="Enter your username" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Password</label>
                            <input type="password" name="password" placeholder="Enter your password" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" id="remember" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                            </div>
                            <a href="#" class="text-sm text-purple-600 hover:underline">Forgot password?</a>
                        </div>

                        <button type="submit" class="w-full bg-purple-600 text-white font-semibold py-3 rounded-lg hover:bg-purple-700 transition">
                            Sign In
                        </button>
                    </form>

                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Don't have an account?
                            <a href="#" class="text-purple-600 font-medium hover:underline">Sign up</a>
                        </p>
                    </div>
                </div>

                <div class="text-center mt-8 text-gray-500 text-sm">
                    &copy; BonsaRental 2025. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</body>
</html>
