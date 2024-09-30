<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BHMS</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased light:bg-light dark:text-white/50">
    <div class="bg-gray-50 text-black/50 dark:bg-white dark:text-balck/50">
        <div class="relative min-h-screen flex flex-col items-center justify-center">
            <div class="relative w-full max-w-md px-6">
                <main class="mt-6">
                    <div class="mx-auto flex flex-col justify-center items-center bg-white rounded-lg shadow-lg p-8">
                        <img src="{{ asset('images/Logso.png') }}" alt="Logo" class="mb-1" style="width: 300px; height: auto;">

                        <h1 class="text-2xl font-semibold mb-6">Welcome to BHMS</h1>

                        {{-- Admin Links --}}
                        @auth('admin')
                            <a href="{{ route('admin.dashboard') }}" class="mb-4 w-full text-center px-4 py-3 font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">
                                Admin Dashboard
                            </a>
                        @else
                            <a href="{{ route('admin.login') }}" class="mb-4 w-full text-center px-4 py-3 font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">
                                Admin Login
                            </a>
                        @endauth

                        {{-- Owner Links --}}
                        @auth('owner')
                            <a href="{{ route('owner.dashboard') }}" class="mb-4 w-full text-center px-4 py-3 font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">
                                Owner Dashboard
                            </a>
                        @else
                            <a href="{{ route('owner.login') }}" class="mb-4 w-full text-center px-4 py-3 font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">
                                Owner Login
                            </a>
                        @endauth

                        {{-- User Links --}}
                        @auth('web')
                            <a href="{{ route('dashboard') }}" class="mb-4 w-full text-center px-4 py-3 font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">
                                User Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="mb-4 w-full text-center px-4 py-3 font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">
                                User Login
                            </a>
                        @endauth

                    </div>
                </main>
            </div>
        </div>
    </div>
</body>
</html>
