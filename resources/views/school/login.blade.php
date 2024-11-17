<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex justify-center items-center min-h-screen bg-gray-100"> <!-- Added bg-gray-100 to the outer container -->
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md"> <!-- White background card -->


            <div class="relative mb-6">
                <!-- Back Button on the Left -->
                <a href="{{route('welcome')}}"  class="absolute left-0 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>

                <!-- Centered Heading -->
                <h1 class="text-center text-2xl font-bold">SDSO Login</h1>
            </div>



            <form method="POST" action="{{ route('school.login.auth') }}">
                @csrf

                <!-- School Name -->
                <div>
                    <x-input-label for="school_name" :value="__('SDSO Email')" />
                    <x-text-input
                        id="school_name"
                        class="block mt-1 w-full"
                        type="email"
                        name="school_name"
                        :value="old('school_name')"
                        required autofocus
                        autocomplete="school_name" />

                    <x-input-error :messages="$errors->get('school_name')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input
                        id="password"
                        class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                0l

                <!-- Forgot Password and Login Button -->
                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('add-school.page') }}">
                            {{ __('Not registered yet?') }}
                        </a>
                    @endif
<a href=""></a>
                    <x-primary-button class="ml-3">
                        {{ __('Log in') }}
                    </x-primary-button>

                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
