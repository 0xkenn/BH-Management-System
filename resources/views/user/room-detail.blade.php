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
                <h2 class="font-bold text-2xl mb-2 text-gray-800">Room {{ $room->name }}</h2>
                <p class="text-gray-600">Vacancy: {{ $room->vacancy }}</p>
                <p class="text-gray-600">Capacity: {{ $room->capacity }}</p>
                <p class="text-gray-600">Price: ₱{{ number_format($room->price, 2) }}</p>
                <p class="text-gray-600">Available: {{ $room->is_occupied ? 'No' : 'Yes' }}</p>
                <p class="text-gray-600">Average Rating:
                    <span class="text-yellow-500 font-bold">
                        {{ $room->ratings->avg('rating') ? number_format($room->ratings->avg('rating'), 1) : 'No ratings yet' }}
                    </span>
                </p>
            </div>
            <!-- Rating Section -->
            @if ($isApproved == 1)
            <div class="px-8 py-4">
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
                        <button type="submit"
                                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5">
                            Submit Rating
                        </button>
                    </form>
                @endif
            </div>
            @endif
            <!-- Reservation Button -->
            <div class="px-8 py-4">
            <button 
        onclick="document.getElementById('modal').classList.remove('hidden')" 
        class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400"
    >
        BH Policy
    </button>

    <!-- Modal -->
    <div id="modal" class="hidden fixed inset-0 flex items-center justify-center z-50">
        <div class="modal-backdrop fixed inset-0 bg-black opacity-50"></div>

        <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-semibold mb-4">Boarding House Policy</h2>
            <p class="mb-4">{{$description}}</p>
            <button 
                onclick="document.getElementById('modal').classList.add('hidden')" 
                class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400"
            >
                Close
            </button>
        </div>
    </div>

                <button x-data="{ savedRoom: @json($savedRoom), isApproved: @json($isApproved) }"
                        @click="handleReservation($event, savedRoom, isApproved)"
                        class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center transition duration-150"
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

    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const stars = document.querySelectorAll('#rating-stars .star');
            const ratingValue = document.getElementById('rating-value');

            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const value = star.getAttribute('data-value');
                    ratingValue.value = value;

                    stars.forEach(s => {
                        s.classList.toggle('text-yellow-500', s.getAttribute('data-value') <= value);
                        s.classList.toggle('text-gray-400', s.getAttribute('data-value') > value);
                    });
                });
            });
        });

        function handleReservation(event, savedRoom, isApproved) {
    const action = isApproved === 1
        ? 'cancel your approved reservation'
        : savedRoom
        ? 'cancel your pending reservation'
        : 'reserve this room';

    const confirmText = isApproved === 1 ? 'Cancel approved reservation?' : `${action} `;
    const icon = isApproved === 1 ? 'warning' : 'question';

    Swal.fire({
        title: confirmText,
        text: `Are you sure you want to ${action}?`,
        icon: icon,
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
    }).then(result => {
        if (result.isConfirmed) {
            const url = `/save-room/{{ $room->id }}` + (savedRoom ? `?action=cancel` : '');
            axios.post(url)
                .then(() => {
                    if (!savedRoom) {
                        // Show the follow-up modal for new reservations
                        Swal.fire({
                            title: 'Reservation Successful!',
                            text: 'Please you may visit the boarding house 1 to 2 days; if you can\'t visit the boarding house within 2 days the owner will not approve your reservation request and it will be automatically cancelled.',
                            icon: 'info',
                            confirmButtonText: 'OK',
                        }).then(() => {
                            // Optionally reload or redirect after the follow-up modal
                            window.location.reload();
                        });
                    } else {
                        // Reload the page directly for cancellations
                        window.location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
}

    </script>
</x-app-layout>
