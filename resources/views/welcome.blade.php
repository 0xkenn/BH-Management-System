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
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    {{-- <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                      
                     
                    </header> --}}

                    <main class="mt-6">
                        <div
                        class="mx-auto flex flex-col justify-center align-middle items-center min-w-0 bg-white rounded-lg shadow-xs dark:bg-gray-800 max-w-96 p-5"
                      >
                       
                     @auth('admin')
                     @if (Auth::guard('admin')->check())
                    
                        <a
                        href="{{route('admin.dashboard')}}" class="px-10 my-5 py-4 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                      >
                        Admin Dashboard
                      </a>
                      
                     
                      @endauth
                     @else
                     <a
                     href="{{route('admin.login')}}" class="px-10 my-5 py-4 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                   >
                     Admin Login
                   </a>
                       
                     @endif
                     
                     
                    {{-- <a
                  href="{{route('')}}" class="px-10 my-5 py-4 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  School Login
                </a> --}}

                @auth('owner')
                  @if(Auth::guard('owner')->check())
                  <a
                  href="{{route('owner.dashboard')}}" class="px-10 my-5 py-4 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Owner Dashboard
                </a>
                @endauth
                @else
                <a
                  href="{{route('owner.login')}}" class="px-10 my-5 py-4 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Owner Login
                </a>
                @endif


                @auth('web')
                @if (Auth::guard('web')->check())
                <a
                href="{{ route('dashboard') }}" class="px-10 my-5 py-4 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
              >
                User Dashboard
              </a>
              @endauth
                @else
                <a
                href="{{ route('login') }}" class="px-10 my-5 py-4 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
              >
                User Login
              </a>
                @endif
                  
               
                      </div>
                    </main>

                  
                </div>
            </div>
        </div>
    </body>
</html>
