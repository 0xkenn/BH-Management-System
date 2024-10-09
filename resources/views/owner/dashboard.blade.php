@auth('owner')
<x-owner-layout>
    <div class="container mx-auto p-6">
        <!-- Row with Two Boxes -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">
            <!-- Left Box: Graph -->
            <div class="bg-white border border-gray-300 rounded shadow-lg h-64">
                <h2 class="font-semibold text-lg p-4 border-b bg-gray-100">Reservations Graph</h2>
                <div class="flex items-center justify-center h-full">

                </div>
            </div>

            <!-- Right Box: Statistics -->
            <div class="bg-white border border-gray-300 rounded shadow-lg h-64">
                <h2 class="font-semibold text-lg p-4 border-b bg-gray-100">Total Reservation</h2>

            </div>
        </div>

        <!-- ListView of User Reservations -->
        <div class="bg-white border border-gray-300  shadow-lg">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">User Name</th>
                        <th class="px-4 py-3">Address</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-1 py-1">Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</x-owner-layout>
@endauth
