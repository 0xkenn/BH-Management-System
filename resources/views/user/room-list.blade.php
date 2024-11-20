<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Search Form -->
        <form id="preferencesForm" method="GET" action="{{ route('rooms.search') }}" class="flex items-center space-x-4 p-4 bg-white rounded-lg shadow-md">
            <div class="relative flex-grow">
                <!-- Search Input -->
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by room or boarding house name"
                    class="w-full px-5 py-3 text-gray-700 bg-gray-100 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 transition duration-200 ease-in-out"
                />

                <!-- Preferences Dropdown Toggle -->
                <button
                    type="button"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 focus:outline-none"
                    id="dropdownBgHoverButton"
                    data-dropdown-toggle="dropdownBgHover"
                    aria-expanded="false"
                    aria-haspopup="true"
                >
                    <!-- Icon for preferences dropdown -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-500 transition duration-200 transform hover:scale-110">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5" />
                    </svg>
                </button>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="px-6 py-3 text-white bg-green-500 rounded-full shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-200 ease-in-out">
                Search
            </button>
        </form>

        <!-- Preferences Dropdown -->
        <div id="dropdownBgHover" class="absolute z-20 hidden w-full md:w-96 bg-white rounded-lg shadow-lg border border-gray-200 mt-2">
            <div class="p-4 text-sm text-gray-700">
                <ul class="space-y-4">
                    @foreach ($allPreferences as $category => $prefs)
                        <li>
                            <span class="font-semibold text-gray-900">{{ ucfirst($category) }}</span>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                                @foreach ($prefs as $preference)
                                    <div class="flex items-center p-2 rounded transition-colors hover:bg-gray-100">
                                        <input
                                            id="preference-{{ $preference->id }}"
                                            name="preferences[]"
                                            type="checkbox"
                                            value="{{ $preference->id }}"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                        >
                                        <label for="preference-{{ $preference->id }}" class="ml-2 text-sm font-medium text-gray-900">
                                            {{ $preference->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <script>
            // Toggle Dropdown
            document.getElementById('dropdownBgHoverButton').addEventListener('click', function () {
                const dropdown = document.getElementById('dropdownBgHover');
                dropdown.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            window.addEventListener('click', function(e) {
                const dropdown = document.getElementById('dropdownBgHover');
                const button = document.getElementById('dropdownBgHoverButton');
                if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        </script>


<!-- Pagination Buttons (Back and Next) -->
<div class="flex space-x-4 justify-end mt-6">
    <!-- Back Button -->
    @if ($rooms->onFirstPage())
    <span class="text-gray-500">No previous page</span>
@else
    <a href="{{ $rooms->previousPageUrl() }}" class="px-6 py-3 text-white bg-blue-600 rounded-full shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200 ease-in-out">
        Back
    </a>
@endif

@if ($rooms->hasMorePages())
    <a href="{{ $rooms->nextPageUrl() }}" class="px-6 py-3 text-white bg-blue-600 rounded-full shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200 ease-in-out">
        Next
    </a>
@else
    <span class="text-gray-500">No next page</span>
@endif

</div>
        <!-- Room Viewer Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
            <!-- Room Card -->
            @forelse ($rooms as $room)
                @if(!$room->is_occupied)
                    <div class="bg-white border border-gray-300 rounded-lg shadow-md transition-transform duration-300 hover:shadow-lg">
                        <img src="{{ asset('storage/' . $room->room_image_1) }}" alt="{{ $room->name }}" class="rounded-t-lg h-48 w-full object-cover">
                        <div class="p-4">
                            <h2 class="text-xl font-bold text-gray-800">Room {{ $room->name }}</h2>
                            <h3 class="text-md text-gray-600">{{ $room->boarding_house->name }}</h3>
                            <p class="mt-2 text-gray-600">{{ Str::limit($room->boarding_house->description, 80) }}</p>
                        </div>
                        <div class="p-4 flex justify-between items-center border-t border-gray-300">
                            <span class="text-gray-700 font-semibold">Monthly Rate</span>
                            <span class="text-green-600 font-semibold">₱{{ number_format($room->price, 2) }}/month</span>
                        </div>
                        <div class="p-4 border-t border-gray-300">
                            <a href="{{ route('user.room-details', $room->id) }}" class="block text-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500 focus:outline-none transition duration-150">
                                View Details
                            </a>
                        </div>
                    </div>
                @endif
            @empty
                <div class="col-span-3 text-center text-gray-700">No rooms found</div>
            @endforelse
        </div>


    </div>
</x-app-layout>
