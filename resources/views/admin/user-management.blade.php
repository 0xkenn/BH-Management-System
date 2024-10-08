<x-admin-layout>
    <h1 class="flex justify-center items-center text-2xl font-bold my-4">User Management Page</h1>

    <div class="overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
                        <th class="px-4 py-3">User</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <p class="font-semibold">Michael Brown</p>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">michaelbrown@example.com</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" color="red"  viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                  </svg>

                            </div>
                        </td>
                    </tr>

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
</x-admin-layout>
