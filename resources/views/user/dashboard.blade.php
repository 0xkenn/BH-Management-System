<x-app-layout>
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                    @forelse ($boardingHouses as $boardingHouse)
                        <div class="card bg-white border border-gray-300 shadow-lg rounded-lg transition-transform transform hover:scale-105">
                            <div class="card-body p-4">
                                <h2 class="card-title text-lg font-semibold flex justify-between items-center">
                                    <span class="text-gray-800">{{ $boardingHouse->name }}</span>
                                    @if ($boardingHouse->created_at >= \Carbon\Carbon::now()->subWeek())
                                        <span class="badge badge-success text-white bg-blue-500 border border-green-500">New</span>
                                    @else
                                        <span class="badge badge-success text-white bg-green-500 border border-green-500">Available</span>
                                    @endif
                                </h2>
                                <p class="text-gray-700 text-sm mt-2">{{$boardingHouse->description}}</p>

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

                                <!-- Boarding House Details -->
                                <p><strong>Name:</strong> {{ $boardingHouse->name }}</p>
                                <p><strong>Description:</strong> {{$boardingHouse->description}} </p>
                                <p><strong>Status:</strong> {{ $boardingHouse->created_at >= \Carbon\Carbon::now()->subWeek() ? 'New' : 'Available' }}</p>
                                <p><strong>Location:</strong>  {{$boardingHouse->address}}</p>
                                
                                <!-- Rooms Carousel -->
                                <div id="rooms-carousel" class="relative w-full mt-4" data-carousel="static">
                                    <!-- Carousel wrapper -->
                                    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                                        @foreach ($boardingHouse->rooms as $index => $room)
                                            <div class="{{ $index === 0 ? '' : 'hidden' }} duration-700 ease-in-out" data-carousel-item>
                                                <div class="flex flex-col items-center">
                                                    <!-- Room Image -->
                                                    <img src="{{ asset('storage/' . $room->room_image_1) }}" class="block w-full h-48 object-cover rounded-lg" alt="Room Image">
                                                    
                                                    <!-- Room Details -->
                                                    <div class="mt-2 text-center">
                                                        <h6 class="text-lg font-semibold">Room Number: {{ $room->name }}</h6>
                                                        <p><strong>Capacity:</strong> {{ $room->capacity }}</p>
                                                        <p class="text-gray-600">{{ $room->is_occupied ? 'Occupied' : 'Available' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Slider controls -->
                                    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                            </svg>
                                            <span class="sr-only">Previous</span>
                                        </span>
                                    </button>
                                    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                            </svg>
                                            <span class="sr-only">Next</span>
                                        </span>
                                    </button>
                                </div>

                                <!-- Reservation Button -->
                                @if (auth()->guard('web')->check())
                                    @foreach ($boardingHouse->rooms as $room)
                                        @if (!$room->is_occupied)  <!-- Show button only for available rooms -->
                                            <a href="{{ route('user.room-details', $room->id) }}" class="mt-4 block w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 text-center">View Room</a>
                                            @break  <!-- Exit loop after the first available room -->
                                        @endif
                                    @endforeach
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
