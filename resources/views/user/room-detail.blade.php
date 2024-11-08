<x-app-layout>
    <div class="flex items-center justify-center p-10">
        <div class="max-w-5xl rounded-lg overflow-hidden shadow-lg bg-white"> <!-- Increased width -->
            <div class="grid grid-cols-2 gap-2 p-5">
                @if ($room->room_image_1)
                    <img class="w-full h-32 object-cover rounded-lg" src="{{ asset('storage/' . $room->room_image_1) }}" alt="Room Image 1">
                @else
                    <img class="w-full h-32 object-cover rounded-lg" src="https://via.placeholder.com/800x300" alt="Placeholder Image 1">
                @endif

                @if ($room->room_image_2)
                    <img class="w-full h-32 object-cover rounded-lg" src="{{ asset('storage/' . $room->room_image_2) }}" alt="Room Image 2">
                @else
                    <img class="w-full h-32 object-cover rounded-lg" src="https://via.placeholder.com/800x300" alt="Placeholder Image 2">
                @endif

                @if ($room->room_image_3)
                    <img class="w-full h-32 object-cover rounded-lg" src="{{ asset('storage/' . $room->room_image_3) }}" alt="Room Image 3">
                @else
                    <img class="w-full h-32 object-cover rounded-lg" src="https://via.placeholder.com/800x300" alt="Placeholder Image 3">
                @endif

                @if ($room->room_image_4)
                    <img class="w-full h-32 object-cover rounded-lg" src="{{ asset('storage/' . $room->room_image_4) }}" alt="Room Image 4">
                @else
                    <img class="w-full h-32 object-cover rounded-lg" src="https://via.placeholder.com/800x300" alt="Placeholder Image 4">
                @endif
            </div>
            <div class="px-8 py-6">
                <div class="font-bold text-2xl mb-2 text-gray-800">Room {{ $room->name }}</div>
                <p class="text-gray-600">Vacancy: {{ $room->capacity }}</p>
                <p class="text-gray-600">Capacity: {{ $room->vacancy }}</p>
                <p class="text-gray-600">Price: ₱{{ number_format($room->price, 2) }}</p>
                <p class="text-gray-600">Available: {{ $room->is_occupied == 0 ? 'Yes' : 'No' }}</p>
            </div>
            <div class="px-8 pt-4 pb-6">
                <div class="inline-block">
                    <button x-data="{ savedRoom: @json($savedRoom), isApproved: @json($isApproved) }"
                    @click="axios.post(`/save-room/{{$room->id}}`)
                        .then(res => { 
                            savedRoom = res.data.savedRoom; 
                            isApproved = res.data.isApproved;
                            // Refresh the page to update the UI with the latest data
                            window.location.reload();
                        })
                        .catch(e => console.log(`error is ${e.message}`))"
                    class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center transition duration-150"
                    :class="{
                        'bg-green-700 hover:bg-green-800 focus:ring-green-300': isApproved === 1,
                        'bg-orange-600 hover:bg-orange-700 focus:ring-orange-300': isApproved === 0
                    }">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                </svg>
                <span x-text="savedRoom ? (isApproved === 1 ? 'Reserved' : 'Cancel reservation') : 'Reserve Now'"></span>
            </button>
            
                </div>
                @if (session()->has('message'))
                    <x-error-toast :message="session()->get('message')"/>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
