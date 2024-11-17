<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-green-100 via-green-200 to-green-400 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <form action="{{ route('school.create.auth') }}" method="post" class="w-full max-w-md p-8 bg-white rounded-xl shadow-md dark:bg-gray-800">
            @csrf
            <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-100 mb-6">Register School Account</h2>

            <!-- Email Field -->
            <div class="mb-5">
                <label for="school_name" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-200">SDSO Email <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                        </svg>
                    </span>
                    <input type="email" name="school_name" id="school_name" required aria-label="SDSO Email" placeholder="Enter SDSO Email"
                        class="w-full pl-10 p-3 border border-gray-300 rounded-lg text-sm bg-gray-50 text-gray-900 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-green-500 dark:focus:border-green-500">
                </div>
                @error('school_name')
                    <div class="text-sm text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-200">Password <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                        </svg>
                    </span>
                    <input type="password" name="password" id="password" required aria-label="Password" placeholder="Enter Password"
                        class="w-full pl-10 p-3 border border-gray-300 rounded-lg text-sm bg-gray-50 text-gray-900 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-green-500 dark:focus:border-green-500">
                </div>
                @error('password')
                    <div class="text-sm text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full px-4 py-3 text-white bg-green-600 rounded-lg font-medium hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">Create Account</button>
        </form>
    </div>
</x-guest-layout>
