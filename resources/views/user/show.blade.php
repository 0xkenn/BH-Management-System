<x-app-layout>
    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Room Image -->
        <div class="mb-6">
            <img src="{{ $room->image_url }}" alt="{{ $room->name }}" class="rounded-lg w-full h-96 object-cover">
        </div>

        <!-- Room Details -->
        <h1 class="text-4xl font-bold text-gray-900">{{ $room->name }}</h1>
        <p class="mt-4 text-gray-600">{{ $room->description }}</p>

        <!-- Price and Booking Section -->
        <div class="mt-6">
            <span class="text-2xl font-semibold text-gray-700">${{ $room->price }}/month</span>
            <button class="ml-4 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-500 focus:outline-none">
                Book Now
            </button>
        </div>
    </div>
</x-app-layout>
