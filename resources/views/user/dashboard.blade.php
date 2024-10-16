<x-app-layout>
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex flex-wrap gap-10 items-center justify-center">
                    @forelse ($boardingHouses as $boardingHouse)
                    <div class="card bg-white border border-gray-300 shadow-lg rounded-lg w-96 transition-transform transform hover:scale-105">
                        <div class="card-body p-4">
                            <h2 class="card-title text-lg font-semibold flex justify-between items-center">
                                <span class="text-gray-800">{{ $boardingHouse->name }}</span>
                                @if ($boardingHouse->created_at >= \Carbon\Carbon::now()->subWeek())
                                    <span class="badge badge-success text-white bg-blue-500 border border-green-500">New</span>
                                @else
                                    <span class="badge badge-success text-white bg-green-500 border border-green-500">Available</span>
                                @endif
                            </h2>
                            <p class="text-gray-700 text-sm mt-2">Brief description of the boarding house...</p>

                            <!-- Button to trigger modal -->
                            <label for="modal{{ $boardingHouse->id }}" class="mt-3 block w-full bg-green-600 text-white py-2 rounded cursor-pointer hover:bg-green-700 transition-colors text-center">View Details</label>
                        </div>
                    </div>

                    <!-- Modal -->
                    <input type="checkbox" id="modal{{ $boardingHouse->id }}" class="modal-toggle hidden">
                    <div class="modal fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center">
                        <div class="bg-white p-5 rounded-lg w-11/12 max-w-3xl overflow-hidden">
                            <div class="flex justify-between items-center">
                                <h5 class="text-xl font-bold">{{ $boardingHouse->name }} Details</h5>
                                <label for="modal{{ $boardingHouse->id }}" class="bg-transparent border-none text-xl cursor-pointer">&times;</label>
                            </div>

                            <!-- Image Row Container -->
                            <div class="grid grid-cols-4 gap-4 mt-4">
                                @php
                                    $images = [
                                        asset('images/sample1.jpg'),
                                        asset('images/sample2.jpg'),
                                        asset('images/sample3.jpg'),
                                        asset('images/sample4.jpg'),
                                    ];
                                @endphp

                                @foreach($images as $image)
                                    <div class="flex justify-center">
                                        <img src="{{ $image }}" alt="Sample Image" class="w-full h-48 object-cover rounded-lg">
                                    </div>
                                @endforeach
                            </div>

                            <!-- Boarding House Details -->
                            <div class="mt-4">
                                <p><strong>Name:</strong> {{ $boardingHouse->name }}</p>
                                <p><strong>Description:</strong> Detailed information about the boarding house goes here...</p>
                                <p><strong>Status:</strong> {{ $boardingHouse->created_at >= \Carbon\Carbon::now()->subWeek() ? 'New' : 'Available' }}</p>
                                <p><strong>Location:</strong> The location of the boarding house...</p>
                            </div>

                            <!-- Reservation Button -->
                            @if (auth()->guard('web')->check())
                                <a href="{{ route('user.room-details', $boardingHouse->id) }}" class="mt-4 block w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 text-center">Reserve Now</a>
                            @else
                                <a href="{{ route('login') }}" class="mt-4 block w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 text-center">Log In to Reserve</a>
                            @endif
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-700">No Boarding Houses on the list</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
