
<x-app-layout>
    <div class="notifications">
        @forelse ($unreadNotifications as $notification)
            <div class="notification-item">
                
                <div class="p-4 text-sm mt-10 text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300" role="alert">
                    <span class="font-medium">Reservation Approved on </span>  <span class=" font-bold">{{ $notification->data['room_name'] }}</span>
                    <a  href="{{ route('user.room-details', $notification->data['room_id']) }}" class="text-blue-600 ml-96 hover:underline">View Reservation</a>
                </div>
                
                
            </div>
        @empty
            <p>No notifications available</p>
        @endforelse
    </div>
    
</x-app-layout>


