<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-lg p-8 bg-white rounded-lg shadow-md">
            <h2 class="text-3xl font-semibold text-center mb-6">Edit Profile</h2>

            <form action="{{ route('user.profile.update') }}" method="POST">
                @csrf
                <!-- Assuming you are using PUT for the update method -->

                <!-- Name Field -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                           value="{{ old('name', auth()->user()->name) }}">
                    @error('name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                           value="{{ old('email', auth()->user()->email) }}">
                    @error('email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <!-- Age Field -->
                <div class="mb-4">
                    <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                    <input type="number" id="age" name="age" placeholder="Enter your age" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                           value="{{ old('age', auth()->user()->age) }}">
                    @error('age')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <!-- Gender Dropdown -->
                <div class="mb-4">
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select id="gender" name="gender" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="" disabled>Select your gender</option>
                        <option value="male" {{ (old('gender', auth()->user()->gender) == 'male') ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ (old('gender', auth()->user()->gender) == 'female') ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ (old('gender', auth()->user()->gender) == 'other') ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <!-- Mobile Number Field -->
                <div class="mb-4">
                    <label for="mobile_number" class="block text-sm font-medium text-gray-700">Mobile Number</label>
                    <input type="tel" id="mobile_number" name="mobile_number" placeholder="Enter your mobile number" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                           value="{{ old('mobile_number', auth()->user()->mobile_number) }}">
                    @error('mobile_number')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <!-- Is Student Dropdown -->
                <div class="mb-4">
                    <label for="is_student" class="block text-sm font-medium text-gray-700">Are you a student?</label>
                    <select id="is_student" name="is_student" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="" disabled>Select if you are a student</option>
                        <option value="1" {{ (old('is_student', auth()->user()->is_student) == '1') ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ (old('is_student', auth()->user()->is_student) == '0') ? 'selected' : '' }}>No</option>
                    </select>
                    @error('is_student')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <!-- Current Password Field -->
                <div class="mb-4">
                    <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                    <input type="password" id="current_password" name="current_password" placeholder="Enter your current password" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('current_password')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <!-- New Password Field -->
                <div class="mb-4">
                    <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                    <input type="password" id="new_password" name="new_password" placeholder="Enter a new password" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('new_password')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <!-- Confirm New Password Field -->
                <div class="mb-4">
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm your new password" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('new_password_confirmation')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <!-- Submit and Cancel Buttons -->
                <div class="flex justify-end">
                    <button type="submit" class="inline-flex justify-center px-6 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-500">Save</button>
                    <button type="button" class="ml-3 inline-flex justify-center px-6 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300" onclick="window.history.back();">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
