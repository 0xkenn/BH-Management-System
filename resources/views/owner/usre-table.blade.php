<x-owner-layout>
    <x-slot name="header">

        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Approved User Management') }}
            </h2>

           
          
        </div>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">

                        <div class="w-full overflow-x-auto">
                      
                            <table class="min-w-full table-auto">
                                <thead>
                                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3">User Name</th>
                                        <th class="px-4 py-3">number</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-1 py-1">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($users as $user)
                                    @foreach ($user->reservations as $reservation)
                                        <tr class="bg-gray-50 dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                                            <td class="px-4 py-3">{{ $user->name }}</td>
                                            <td class="px-4 py-3">{{ $user->mobile_number }}</td>
                                            <td class="px-4 py-3">
                                                <span class="{{ $reservation->is_approved ? 'bg-green-500 text-white' : 'bg-orange-500 text-white' }} px-2 py-1 rounded">
                                                    {{ $reservation->is_approved ? 'Approved' : 'Pending' }}
                                                </span>
                                            </td>
                                            <td class="px-1 py-1 flex">
                                                @if (!$reservation->is_approved) <!-- Only show approve button if not already approved -->
                                                    <form action="{{ route('reserve.check', $reservation->id) }}" method="post">@csrf
                                                        <button type="submit" class="text-green-600 hover:text-green-800">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                
                                                <form action="{{ route('reserve.delete', $reservation->id) }}" method="post" class="ml-2">
                                                    @csrf
                                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                
                                
                                </tbody>
                            </table>
                        </div>
                        <div
                          class=" px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
                        >
                      
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</x-owner-layout>
