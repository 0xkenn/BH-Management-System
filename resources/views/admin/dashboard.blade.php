@auth('admin')
<x-admin-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">
                    <h2 class="text-lg font-semibold">Dashboard</h2>

                    <!-- Container for two rows of cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                        <!-- Card for User Count -->
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                            <h3 class="text-xl font-bold">User Count</h3>
                            <p class="text-2xl">0</p> <!-- Replace with dynamic data -->
                        </div>

                        <!-- Card for Building Height (BH) Count -->
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                            <h3 class="text-xl font-bold">Building Height Count</h3>
                            <p class="text-2xl">0</p> <!-- Replace with dynamic data -->
                        </div>

                    </div>

                    <!-- Graph Section -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold">Graph</h3>
                        <div id="graph" style="height: 300px;">
                            <!-- Placeholder for graph rendering -->
                            <p class="text-center">Graph will be displayed here.</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</x-admin-layout>
@endauth
