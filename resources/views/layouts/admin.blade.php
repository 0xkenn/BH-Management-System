<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="cupcake">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" >
    
        <div class="flex  h-screen min-h-screen bg-gray-100 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen}">
            
            @include('admin.admin-sidebar')
            <div class="flex flex-col flex-1 w-full">
            @include('layouts.admin-nav')
            

            <!-- Page Heading -->
            

            <!-- Page Content -->
            <main class="z-20 h-full pb-16 overflow-y-auto bg-gray-200">
                <div class="container grid px-6 mx-auto">
                
                {{ $slot }}
                </div>
            </main>
            </div>
        </div>
    </body>
</html>
