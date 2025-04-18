<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    @if (session()->has('approval'))
        <x-error-toast :message="session()->get('approval')"/>
    @endif

    <!-- Full Page Container with Background Image -->
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-green-100 via-green-200 to-green-400 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
     
        <div class="bg-cover bg-center w-full h-full absolute" style="background-image: url('/path/to/your/background-image.jpg'); opacity: 0.8;"></div>

        <!-- Card Container -->
        <div class="relative z-10 bg-white shadow-lg rounded-lg p-6 sm:p-8 w-full max-w-md">

            <div class="relative mb-6">
                <!-- Back Button on the Left -->
                <a href="{{ route('welcome') }}"  class="absolute left-0 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>

                <!-- Centered Heading -->
                <h1 class="text-2xl font-bold text-center mb-6">Owner Login</h1>
            </div>

            <form method="POST" action="{{ route('login-owner.store') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{old('email')}}" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('owner.register') }}">
                            {{ __('Don\'t have an account yet?') }}
                        </a>
                    @endif

                    <x-primary-button class="ml-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
