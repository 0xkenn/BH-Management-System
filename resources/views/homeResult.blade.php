<x-guest-layout>
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-md p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 mr-2" />
                <a class="font-bold text-xl text-green-600">BoardingHouseMS</a>
            </div>
            <div class="flex items-center">
                <form id="preferencesForm" method="GET" action="{{ route('search') }}" class="flex items-center space-x-2">
                    <div class="relative flex-grow max-w-xs">
                        <input type="text" name="search" placeholder="Search..." class="w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-l-full focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400" />
                        <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3" id="dropdownBgHoverButton" data-dropdown-toggle="dropdownBgHover">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-orange-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5" />
                            </svg>
                        </button>
                    </div>
                    <div class="relative">
                        <div id="dropdownBgHover" class="z-10 hidden w-48 bg-white rounded-lg shadow-lg dark:bg-gray-700">
                            <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownBgHoverButton">
                                @foreach ($preferences as $preference)
                                    <li>
                                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                            <input id="preference-{{ $preference->id }}" name="preferences[]" type="checkbox" value="{{ $preference->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="preference-{{ $preference->id }}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{ $preference->name }}</label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded-full hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">Search</button>
                    </div>
                </form>
                <a href="{{ route('/register-user') }}" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-1 focus:outline-none focus:ring-green-300 font-bold rounded-full text-sm px-5 py-2.5 shadow-lg shadow-green-500/50 transition duration-200 ease-in-out ml-2">Register</a>
                <a href="{{ route('welcome') }}" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-1 focus:outline-none focus:ring-green-300 font-bold rounded-full text-sm px-5 py-2.5 shadow-lg shadow-green-500/50 transition duration-200 ease-in-out ml-2">LogIn</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex p-5 container mx-auto">
        <aside class="w-full md:w-64 bg-gray-200 border-r border-gray-300 p-4 hidden md:block rounded-lg shadow-md mx-auto">
            <h3 class="text-lg text-gray-800 font-bold mb-4 text-center">News & Updates</h3>
            <ul class="list-none p-0">
                <li class="mb-4">
                    <a href="#" class="text-green-600 hover:underline font-bold text-center">Latest Updates on Housing</a>
                    <p class="text-gray-600 text-sm mt-1 text-justify">Stay informed about the latest regulations and developments affecting housing in your area.</p>
                </li>
            </ul>
        </aside>

        <!-- Main Listings -->
        <main class="flex-1 pl-5">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if (count($topResults) > 0)
                    @foreach ($topResults as $result)
                        <?php $boardingHouse = $result['boarding_house']; ?>
                        <div class="border border-gray-300 rounded-lg overflow-hidden bg-white shadow-md hover:shadow-lg transition-shadow duration-300">
                            <div class="flex justify-center">
                                @if($boardingHouse->background_image)
                                    <img src="{{ asset('storage/' . $boardingHouse->background_image) }}" alt="{{ $boardingHouse->name }}" class="w-full h-48 object-cover">
                                @else
                                    <img src="{{ asset('images/placeholder.png') }}" alt="Placeholder" class="w-full h-48 object-cover">
                                @endif
                            </div>
                            <div class="p-4">
                                <h5 class="text-lg font-bold text-gray-800">{{ $boardingHouse->name }}</h5>
                                <p class="text-gray-600"><i>{{ $boardingHouse->address }}</i></p>
                                <p class="text-gray-700 text-sm leading-relaxed">{{ Str::limit($boardingHouse->description, 80) }}</p>
                                <label for="modal{{ $boardingHouse->id }}" class="mt-3 block w-full bg-green-600 text-white py-2 rounded cursor-pointer hover:bg-green-700 transition-colors text-center">View Details</label>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No results found</p>
                @endif
            </div>
        </main>
    </div>
</x-guest-layout>
