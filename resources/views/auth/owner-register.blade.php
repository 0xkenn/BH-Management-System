<x-guest-layout>
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">{{ __('Register as Owner') }}</h2>

        <form method="POST" action="{{ route('register-owner.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-2 w-full"
                              type="text" name="name" :value="old('name')"
                              required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-2 w-full"
                              type="email" name="email" :value="old('email')"
                              required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Address -->
            <div class="mb-4">
                <x-input-label for="address" :value="__('Address')" />
                <x-text-input id="address" class="block mt-2 w-full"
                              type="text" name="address" :value="old('address')"
                              required autocomplete="address-line1" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <!-- Mobile Number -->
            <div class="mb-4">
                <x-input-label for="mobile_number" :value="__('Mobile Number')" />
                <x-text-input id="mobile_number" class="block mt-2 w-full"
                              type="tel" name="mobile_number" :value="old('mobile_number')"
                              required autocomplete="tel" />
                <x-input-error :messages="$errors->get('mobile_number')" class="mt-2" />
            </div>

            <!-- Business Permit -->
            <div class="mb-4">
                <x-input-label for="business_permit" :value="__('Business Permit (PDF)')" />
                <input id="business_permit" type="file"
                       class="block mt-2 w-full text-sm text-gray-500 border rounded-lg"
                       name="business_permit" accept="application/pdf" required />
                <x-input-error :messages="$errors->get('business_permit')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-2 w-full"
                              type="password" name="password"
                              required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-2 w-full"
                              type="password" name="password_confirmation"
                              required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Already Registered? & Submit Button -->
            <div class="flex items-center justify-between mt-6">
                <a class="text-sm text-indigo-600 hover:text-indigo-800 underline"
                   href="{{ url('/login-user') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
