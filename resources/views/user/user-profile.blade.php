<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-lg p-8 bg-white rounded-lg shadow-md">
            <h2 class="text-3xl font-semibold text-center mb-6">Edit Profile</h2>

            <form>
                <!-- Name Field -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Age Field -->
                <div class="mb-4">
                    <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                    <input type="number" id="age" name="age" placeholder="Enter your age" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Gender Dropdown -->
                <div class="mb-4">
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="" disabled selected>Select your gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <!-- Mobile Number Field -->
                <div class="mb-4">
                    <label for="mobile_number" class="block text-sm font-medium text-gray-700">Mobile Number</label>
                    <input type="tel" id="mobile_number" name="mobile_number" placeholder="Enter your mobile number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Is Student Dropdown -->
                <div class="mb-4">
                    <label for="is_student" class="block text-sm font-medium text-gray-700">Are you a student?</label>
                    <select id="is_student" name="is_student" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="" disabled selected>Select if you are a student</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter a new password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Confirm Password Field -->
                <div class="mb-4">
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your new password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Submit and Cancel Buttons -->
                <div class="flex justify-end">
                    <button type="button" class="inline-flex justify-center px-6 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-500">Save</button>
                    <button type="button" class="ml-3 inline-flex justify-center px-6 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
