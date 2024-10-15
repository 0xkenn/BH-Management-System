<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Room Viewer Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Room Card 1 -->
         @forelse ($rooms as $room)
         <div class="bg-white border border-gray-200 rounded-lg shadow-lg transition-transform duration-300">
            <img src="{{asset('storage/'.$room->room_image_1)}}" alt="Room 1" class="rounded-t-lg h-48 w-full object-cover">
            <div class="p-4">
                <h2 class="text-xl font-semibold text-gray-800">{{$room->name}} | {{$room->boarding_house->name}}</h2>
                <p class="mt-2 text-gray-600">{{$room->boarding_house->description}}</p>
            </div>
            <div class="p-4 flex justify-between items-center border-t border-gray-200">
                <span class="text-gray-700 font-semibold text-lg">Monthly Rate</span>
                <span class="text-gray-600 font-semibold text-lg">${{$room->price}}/month</span>
            </div>
            <div class="p-4 flex justify-end border-t border-gray-200">
                <a href="{{ route('user.room-details', $room->id ) }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500 focus:outline-none transition duration-150">
                    View Details
                </a>
            </div>
        </div>
         @empty
             no rooms found
         @endforelse
            
        </div>
    </div>
</x-app-layout>