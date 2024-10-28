<x-admin-layout>

    <!-- Table for BH items with headers in dark theme -->
    <div class="mt-6">
        <table class="min-w-full bg-gray-800 rounded shadow-md">
            <thead>
                <tr class="bg-gray-700 text-gray-300 uppercase text-sm rounded">
                    <th class="py-3 px-4 text-left">BH Name</th>
                    <th class="py-3 px-4 text-left">Owner</th>
                    <th class="py-3 px-4 text-left">Address</th>
                    <th class="py-3 px-4 text-left">Permit</th>
                    <th class="py-3 px-4 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-600">
                @foreach ($boarding_houses as $boarding_house)
                <tr class="text-gray-200">
                    <td class="py-3 px-4 flex items-center space-x-4">

                    <!-- BH Image -->
                        <img src="{{ asset('storage/' . $boarding_house->background_image) }}" alt="BH Image" class="w-12 h-12 rounded-full object-cover border-2 border-gray-500">
                        <span class="font-bold">{{ $boarding_house->name }}</span>
                    </td>


                    <td class="py-3 px-4 text-gray-300">
                        <span class="font-bold">{{ $boarding_house->owner->name }}</span>
                    </td>
                    <td class="py-3 px-4 text-gray-300">
                        <span class="font-bold">{{ $boarding_house->address }}</span>
                    </td>

                    {{-- Permit --}}
                    <td>
                        <a href="#permit_data_{{$boarding_house->id}}"
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Permit"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m-7 4h8a2 2 0 002-2V6a2 2 0 00-2-2H8a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </a>

                            <div class="modal" role="dialog" id="permit_data_{{$boarding_house->id}}">
                                    <div class="modal-box">

                                    <img src="{{asset('storage/'.$boarding_house->business_permit_image)}}" alt="">
                                    <div class="modal-action">
                                        <a href="#" class="btn">back</a>
                                    </div>
                            </div>
                        </div>
                    </td>

                    <td class="py-3 px-4">
                        <form action="{{route('bh.delete.admin', $boarding_house->id)}}" method="post">@csrf
                            <button class="text-red-400 hover:text-red-600 transition-colors duration-300">
                                <!-- Delete Icon -->
                                <svg class="w-5 h-5" fill="red" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H5a1 1 0 100 2h10a1 1 0 100-2h-2.382l-.724-1.447A1 1 0 0011 2H9zm-4 6a1 1 0 011-1h8a1 1 0 011 1v7a2 2 0 01-2 2H7a2 2 0 01-2-2V8z" clip-rule="evenodd"/>
                                  </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
