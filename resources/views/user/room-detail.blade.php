<x-app-layout>
    <div class="flex items-center justify-center p-10">
        <div class="max-w-5xl rounded-lg overflow-hidden shadow-lg bg-white">
            <!-- Room Images -->
            <div class="grid grid-cols-2 gap-2 p-5">
                @for ($i = 1; $i <= 4; $i++)
                    <img class="w-full h-32 object-cover rounded-lg"
                        src="{{ $room->{'room_image_' . $i} ? asset('storage/' . $room->{'room_image_' . $i}) : 'https://via.placeholder.com/800x300' }}"
                        alt="Room Image {{ $i }}">
                @endfor
            </div>
            <!-- Room Details -->
            <div class="px-8 py-6">
                <div class="font-bold text-2xl mb-2 text-gray-800">Room {{ $room->name }}</div>
                <p class="text-gray-600">Vacancy: {{ $room->capacity }}</p>
                <p class="text-gray-600">Capacity: {{ $room->vacancy }}</p>
                <p class="text-gray-600">Price: ₱{{ number_format($room->price, 2) }}</p>
                <p class="text-gray-600">Available: {{ $room->is_occupied == 0 ? 'Yes' : 'No' }}</p>
                <p class="text-gray-600">Average Rating: 
                    <span class="text-yellow-500 font-bold">
                        {{ number_format($room->ratings->avg('rating'), 1) ?? 'No ratings yet' }}
                    </span>
                </p>
            </div>
            <!-- Rating Section -->
            <div class="flex">
                <div class="px-8 pt-4 pb-6">
                    @if (!$userHasRating) 
                    <form method="POST" action="{{ route('rate-room', $room->id) }}">
                        @csrf
                        <label for="rating" class="block text-gray-700 font-bold mb-2">Rate this Room:</label>
                        <div id="rating-stars" class="flex items-center mb-4">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg data-value="{{ $i }}" class="w-6 h-6 text-gray-400 hover:text-yellow-500 cursor-pointer star"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 15.27L16.18 18l-1.64-7.03L20 7.24l-7.19-.61L10 0 7.19 6.63 0 7.24l5.46 3.73L3.82 18z" />
                                </svg>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating-value">
                        <div class="flex items-center space-x-4"> <!-- Flex container for buttons -->
                            <button type="submit"
                                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Submit Rating
                            </button>
                        </form>
                        @endif
                            <button x-data="{ savedRoom: @json($savedRoom), isApproved: @json($isApproved) }"
                                @click="axios.post(`/save-room/{{$room->id}}`)
                                    .then(res => { 
                                        savedRoom = res.data.savedRoom; 
                                        isApproved = res.data.isApproved;
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
                    
                </div>
            </div>
            
            

            {{-- end reserve --}}
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('#rating-stars .star');
    const ratingValue = document.getElementById('rating-value');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const value = star.getAttribute('data-value');
            ratingValue.value = value;

            // Fill stars up to the selected one
            stars.forEach(s => {
                if (s.getAttribute('data-value') <= value) {
                    s.classList.add('text-yellow-500');
                    s.classList.remove('text-gray-400');
                } else {
                    s.classList.add('text-gray-400');
                    s.classList.remove('text-yellow-500');
                }
            });
        });
    });
});

    </script>
</x-app-layout>
