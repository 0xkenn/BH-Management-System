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
                        {{ number_format($room->ratings->avg('rating'), 1) ?? 'No ratings yet' }}
                    </span>
                </p>
            </div>
            <!-- Rating Section -->
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
           <!-- Reservation Button -->
<div class="px-8 py-4">
    <button x-data="{ savedRoom: @json($savedRoom), isApproved: @json($isApproved) }"
            @click="handleReservation(savedRoom, isApproved)"
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

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const stars = document.querySelectorAll('#rating-stars .star');
        const ratingValue = document.getElementById('rating-value');

        // Star rating functionality
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

        // Reservation handling
        window.handleReservation = (savedRoom, isApproved) => {
            console.log('Handle Reservation triggered', savedRoom, isApproved); // Debugging line
            
            const action = isApproved === 1 ? 'cancel your reservation' : 'reserve this room';
            const confirmText = isApproved === 1 ? 'Cancel reservation?' : 'Confirm reservation';

            // First confirmation for reservation or cancellation
            Swal.fire({
                title: confirmText,
                text: `Are you sure you want to ${action}?`,
                icon: isApproved === 1 ? 'warning' : 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then(result => {
                if (result.isConfirmed) {
                    if (isApproved === 1) {
                        console.log('Cancel reservation confirmed');  // Debugging line

                        // Second confirmation before cancelling
                        Swal.fire({
                            title: 'Are you really sure?',
                            text: 'This action cannot be undone!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, cancel it!',
                            cancelButtonText: 'No, keep it'
                        }).then(confirmCancel => {
                            if (confirmCancel.isConfirmed) {
                                console.log('Cancel action confirmed');  // Debugging line

                                // Make the API call to cancel reservation
                                axios.post(`/save-room/{{ $room->id }}?action=cancel`)
                                    .then(res => {
                                        console.log('API response:', res); // Debugging line
                                        savedRoom = res.data.savedRoom;
                                        isApproved = res.data.isApproved;
                                        window.location.reload(); // Reload to reflect changes
                                    })
                                    .catch(error => console.error('Error:', error));
                            }
                        });
                    } else {
                        console.log('Reserve action confirmed');  // Debugging line
                        
                        // Confirm reservation
                        axios.post(`/save-room/{{ $room->id }}`)
                            .then(res => {
                                console.log('API response:', res); // Debugging line
                                savedRoom = res.data.savedRoom;
                                isApproved = res.data.isApproved;
                                window.location.reload(); // Reload to reflect changes
                            })
                            .catch(error => console.error('Error:', error));
                    }
                }
            });
        };
    });
</script>


</x-app-layout>
