<x-guest-layout>


    <div class="bg-gray-50 text-black/50 dark:bg-white dark:text-balck/50">
        <div class="relative min-h-screen flex flex-col items-center justify-center">
            <div class="relative w-full max-w-md px-6">
                <main class="mt-6">
                    <div class="mx-auto flex flex-col justify-center items-center bg-white rounded-lg shadow-lg p-8">
                        <img src="{{ asset('images/Logso.png') }}" alt="Logo" class="mb-1" style="width: 300px; height: auto;">

                        <h1 class="text-2xl font-semibold mb-6">Welcome to BHMS</h1>
<div class="grid gap-3 mb-2 md:grid-cols-2">
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
                            {{-- school link --}}
                            <a href="{{ route('school.login') }}" class="mb-4 w-full text-center px-4 py-3 font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">
                                SDSO Login
                            </a>


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
                            <a href="{{ route('user.dashboard') }}" class="mb-4 w-full text-center px-4 py-3 font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">
                                User Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="mb-4 w-full text-center px-4 py-3 font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">
                                User Login
                            </a>
                        @endauth
                    </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

</x-guest-layout>
