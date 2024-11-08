<x-app-layout>
    <div class="notifications p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Notifications</h1>

        @forelse ($unreadNotifications as $notification)
            <div class="notification-item mb-4">
                <div class="p-4 text-sm rounded-lg shadow-md transition duration-300 ease-in-out hover:shadow-lg 
                            {{ isset($notification->data['status']) && $notification->data['status'] === 'Approved' ? 'bg-green-100 text-gray-800' : 'bg-red-100 text-gray-800' }}" role="alert">
                    
                    <span class="font-medium">
                        {{ isset($notification->data['status']) && $notification->data['status'] === 'Approved' ? 'Reservation Approved:' : 'Reservation Deleted:' }}
                    </span>
                    <span class="font-bold"> Room {{ $notification->data['room_name'] }}</span>
                    <a href="{{ route('user.room-details', $notification->data['room_id']) }}" class="text-blue-600 hover:underline float-right">View Reservation</a>
                </div>
            </div>
        @empty
            <div class="text-center p-4 text-gray-500">
                <p class="text-lg">No notifications available</p>
            </div>
        @endforelse
    </div>
</x-app-layout>
