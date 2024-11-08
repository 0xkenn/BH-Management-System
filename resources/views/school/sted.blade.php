<x-school-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200 mb-6">Student Information</h1>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <thead class="bg-gray-200 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Profile
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Boarding Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Contact Number
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Address
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Course
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    <!-- Sample Row -->
                    <tr>
                        @foreach ($users as $user)
                        <td class="px-6 py-4 whitespace-nowrap flex items-center">
                            <img class="w-10 h-10 rounded-full mr-3" src="{{asset('storage/'.$user->profile_image)}}" alt="John Doe Profile">
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-200">{{$user->user_name}}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                          
                      {{$user->boarding_house_name}}
                        
                         
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{$user->mobile_number}}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            Brgy. {{$user->brgy}} {{$user->muni}}, {{$user->prov}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        
                           {{$user->program_abbrev}}
                          
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-school-layout>
