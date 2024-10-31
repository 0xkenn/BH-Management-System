<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Room Viewer Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
