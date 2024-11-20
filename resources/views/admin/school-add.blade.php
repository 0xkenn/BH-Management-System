<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-green-100 via-green-200 to-green-400 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        
        <form action="{{ route('school.create.auth') }}" method="post" class="w-full max-w-md p-8 bg-white rounded-xl shadow-md dark:bg-gray-800">
            @csrf
            
            
            <div class="relative mb-6">
                <!-- Back Button on the Left -->
                <a href="{{route('welcome')}}"  class="absolute left-0 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>

                <!-- Centered Heading -->
                <h1 class="text-center text-2xl font-bold"> Register SDSO Account</h1>
            </div>
            <!-- Email Field -->
            <div class="mb-5">
                <label for="school_name" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-200">SDSO Email <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
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
