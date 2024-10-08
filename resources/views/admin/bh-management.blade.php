<x-admin-layout>

    <!-- ListView for BH items with delete icon, image, BH name, and BH owner -->
    <div class="mt-6">
        <ul class="space-y-4">
            <!-- Placeholder for dynamically fetched BH items -->
            <!-- This will be generated based on data fetched from the database -->
           @foreach ($boarding_houses as $boarding_house)
           <li class="flex justify-between items-center p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <!-- Left section: BH Image and Information -->
            <div class="flex items-center space-x-4">
                <!-- BH Image -->
                <img src="{{asset('storage/' . $boarding_house->background_image)}}" alt="BH Image" class="w-12 h-12 rounded-full object-cover border-2 border-gray-300">

                <!-- BH Name and Owner -->
                <div>
                    <span class="block font-bold text-lg">{{$boarding_house->name}}</span>
                    <span class="block font-bold text-gray-600"> {{$boarding_house->owner->name}} </span>
                </div>
            </div>

            <!-- Right section: Delete Button -->
            <button class="text-red-500 hover:text-red-700 transition-colors duration-300">
                <!-- Delete Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
            </button>
        </li>
           @endforeach

            <!-- Additional BH items will be dynamically inserted here -->
            

          

            <!-- Add more items here if needed -->
        </ul>
    </div>
</x-admin-layout>
