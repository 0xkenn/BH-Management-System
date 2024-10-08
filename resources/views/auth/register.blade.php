<x-guest-layout>
    <form method="POST" action="{{ route('/auth/reguster-user') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Age  --}}
        <div class="mt-4">
            <x-input-label for="age" :value="__('age')" />
            <x-text-input id="age" class="block mt-1 w-full" type="number" name="age" :value="old('age')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('age')" class="mt-2" />
        </div>
{{-- gender --}}

<div class="mt-4">
    <x-input-label for="gender" :value="__('Gender')" />
<select id="gender" name="gender" class="block mt-1 w-full">
    <option value="">Select Gender</option>
    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
    <option value="prefer_not_to_say" {{ old('gender') == 'prefer_not_to_say' ? 'selected' : '' }}>Prefer not to say</option>
</select>
<x-input-error :messages="$errors->get('gender')" class="mt-2" />
</div>

{{-- mobile number --}}
<div class="mt-4">
    <x-input-label for="mobile_number" :value="__('mobile_number')" />
    <x-text-input id="mobile_number" class="block mt-1 w-full" type="tel" name="mobile_number" :value="old('mobile_number')" required autocomplete="username" />
    <x-input-error :messages="$errors->get('mobile_number')" class="mt-2" />
</div>


{{-- partial --}}
<div class="mt-4">
    <x-input-label for="is_student" :value="__('is_student')" />
<select id="is_student" name="is_student" class="block mt-1 w-full">
    <option value="">Select is_student</option>
    <option value="true" {{ old('is_student') == 'true' ? 'selected' : '' }}>Yes</option>
    <option value="false" {{ old('is_student') == 'false' ? 'selected' : '' }}>No</option>
</select>
<x-input-error :messages="$errors->get('is_student')" class="mt-2" />
</div>


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4" >
                {{ __('Register') }}
            </x-primary-button>
            <a class="ms-4 bg-red-700 text-white py-2 px-4 rounded hover:bg-red-800 transition-colors" href="{{ url('/') }}">
                {{ __('Cancel') }}
            </a>
        </div>
    </form>
</x-guest-layout>
