<x-app-layout>
    <h1 class="flex justify-center items-center text-2xl font-bold my-4">User Management Page</h1>

    <div class="overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
                        <th class="px-4 py-3">Room Name</th>
                        <th class="px-4 py-3">Boarding House Name</th>
                        <th class="px-4 py-3">Address</th>
                        <th>status</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                  @foreach ($reservedRooms as $reserve)
                  <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <p class="font-semibold">{{$reserve->name}}</p>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">{{$reserve->boarding_house->name}}</td>
                    <td class="px-4 py-3 text-sm">{{$reserve->boarding_house->address}}</td>
                    <td>
                        @foreach ($reserve->reservations as $reservation)
                            <span
                                class="px-2 py-1 font-semibold leading-tight 
                                {{ $reservation->is_approved ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 'text-orange-700 bg-orange-100 dark:text-white dark:bg-orange-600' }} 
                                rounded-full"
                            >
                                {{ $reservation->is_approved ? 'Approved' : 'Pending Approval' }}
                            </span>
                        @endforeach
                    </td>
                    
                    <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">

                            <a href="{{ route('user.room-details', $reserve->id ) }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500 focus:outline-none transition duration-150">
                                View 
                            </a>

                        </div>
                    </td>
                </tr>
                  @endforeach

                    {{-- No users found --}}
                    {{-- Uncomment this section if no users are present --}}
                    {{--
                    <tr>
                        <td colspan="3" class="px-4 py-3 text-center">No users found.</td>
                    </tr>
                    --}}
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
