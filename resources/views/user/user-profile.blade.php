<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Profile</h2>

            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <!-- Profile Picture Field -->
                    <div class="sm:col-span-2 flex flex-col items-center">
                        <label for="profile_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Profile Picture</label>
                        <div class="relative mb-4">
                            <img id="profile-image-preview" 
                                 src="{{ asset('storage/'.auth()->user()->profile_image) }}" 
                                 alt="Profile Preview" 
                                 class="rounded-full w-40 h-40 border border-gray-300 dark:border-gray-600" 
                                 onerror="this.onerror=null;this.src='default-profile.png';" />
                            <input type="file" id="profile_image" name="profile_image" 
                                   class="absolute inset-0 opacity-0 cursor-pointer" 
                                   accept="image/*" 
                                   onchange="previewImage(event)">
                        </div>
                        @error('profile_image')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <!-- Name Field -->
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <!-- Email Field -->
                    <div class="w-full">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            value="{{ old('email', auth()->user()->email) }}" required>
                        @error('email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <!-- Age Field -->
                    <div class="w-full">
                        <label for="age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                        <input type="number" id="age" name="age" placeholder="Enter your age"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            value="{{ old('age', auth()->user()->age) }}" required>
                        @error('age')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <!-- Gender Dropdown -->
                    <div class="w-full">
                        <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                        <select id="gender" name="gender"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                            <option value="" disabled>Select your gender</option>
                            <option value="male" {{ (old('gender', auth()->user()->gender) == 'male') ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ (old('gender', auth()->user()->gender) == 'female') ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ (old('gender', auth()->user()->gender) == 'other') ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <!-- Mobile Number Field -->
                    <div class="w-full">
                        <label for="mobile_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mobile Number</label>
                        <input type="tel" id="mobile_number" name="mobile_number" placeholder="Enter your mobile number"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            value="{{ old('mobile_number', auth()->user()->mobile_number) }}" required>
                        @error('mobile_number')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <!-- Is Student Dropdown -->
                    <div class="w-full">
                        <label for="is_student" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Are you a student?</label>
                        <select id="is_student" name="is_student"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                            <option value="" disabled>Select if you are a student</option>
                            <option value="1" {{ (old('is_student', auth()->user()->is_student) == '1') ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ (old('is_student', auth()->user()->is_student) == '0') ? 'selected' : '' }}>No</option>
                        </select>
                        @error('is_student')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <div class="w-full">
                        <label for="region" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Region*</label>
                        <select id="region" name="region_code" class="region-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Select Region</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->region_code }}">{{ $region->region_description }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('region_code')" class="mt-2" />
                    </div>

                    <!-- Province Dropdown -->
                    <div class="w-full">
                        <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province*</label>
                        <select id="province" name="province_code" class="province-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Select Province</option>
                        </select>
                        <x-input-error :messages="$errors->get('province_code')" class="mt-2" />
                    </div>

                    <!-- City Dropdown -->
                    <div class="w-full">
                        <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City*</label>
                        <select id="city" name="city_municipality_code" class="city-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Select City</option>
                        </select>
                        <x-input-error :messages="$errors->get('city_municipality_code')" class="mt-2" />
                    </div>

                    <!-- Barangay Dropdown -->
                    <div class="w-full">
                        <label for="barangay" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barangay*</label>
                        <select id="barangay" name="barangay_code" class="barangay-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Select Barangay</option>
                        </select>
                        <x-input-error :messages="$errors->get('barangay_code')" class="mt-2" />
                    </div>

                    <!-- Current Password Field -->
                    <div class="w-full">
                        <label for="current_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current Password</label>
                        <input type="password" id="current_password" name="current_password" placeholder="Enter your current password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        @error('current_password')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <!-- New Password Field -->
                    <div class="w-full">
                        <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                        <input type="password" id="new_password" name="new_password" placeholder="Enter a new password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        @error('new_password')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <!-- Confirm New Password Field -->
                    <div class="w-full">
                        <label for="new_password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm New Password</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm your new password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        @error('new_password_confirmation')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                </div>

                <!-- Submit and Cancel Buttons -->
                <div class="flex justify-end mt-4">
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-500 focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900">
                        Save
                    </button>
                    <button type="button" class="ml-3 inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300" onclick="window.history.back();">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>

<script>
    function previewImage(event) {
        const input = event.target;
        const reader = new FileReader();

        reader.onload = function () {
            const img = document.getElementById('profile-image-preview');
            img.src = reader.result;
        };

        if (input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    // Function to dynamically load dropdown options
    function loadOptions(url, targetDropdown) {
        fetch(url)
            .then(response => response.json())
            .then(data => {
                targetDropdown.innerHTML = '<option value="">Select</option>';
                data.forEach(item => {
                    targetDropdown.innerHTML += `<option value="${item.id}">${item.description}</option>`;
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Region to Province
    document.getElementById('region').addEventListener('change', function() {
        const regionId = this.value;
        const provinceDropdown = document.getElementById('province');
        const cityDropdown = document.getElementById('city');
        const barangayDropdown = document.getElementById('barangay');

        // Reset subsequent dropdowns
        provinceDropdown.innerHTML = '<option value="">Select Province</option>';
        cityDropdown.innerHTML = '<option value="">Select City</option>';
        barangayDropdown.innerHTML = '<option value="">Select Barangay</option>';

        if (regionId) {
            loadOptions(`/provinces/${regionId}`, provinceDropdown);
        }
    });

    // Province to City
    document.getElementById('province').addEventListener('change', function() {
        const provinceId = this.value;
        const cityDropdown = document.getElementById('city');
        const barangayDropdown = document.getElementById('barangay');

        // Reset city and barangay dropdowns
        cityDropdown.innerHTML = '<option value="">Select City</option>';
        barangayDropdown.innerHTML = '<option value="">Select Barangay</option>';

        if (provinceId) {
            loadOptions(`/cities/${provinceId}`, cityDropdown);
        }
    });

    // City to Barangay
    document.getElementById('city').addEventListener('change', function() {
        const cityId = this.value;
        const barangayDropdown = document.getElementById('barangay');

        // Reset barangay dropdown
        barangayDropdown.innerHTML = '<option value="">Select Barangay</option>';

        if (cityId) {
            loadOptions(`/barangays/${cityId}`, barangayDropdown);
        }
    });
</script>