<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

            <div class="p-6"> <!-- Changed to p-6 for uniform padding -->
                <h2 class="text-lg font-semibold text-gray-300">Dashboard</h2>

                <!-- Container for two rows of cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                    <!-- Card for User Count -->
                    <div class="bg-gray-700 p-6 rounded-lg shadow-md"> <!-- Changed to p-6 for uniform padding -->
                        <h3 class="text-xl font-bold text-gray-200">User Count</h3>
                        <p class="text-2xl text-gray-100">wow</p> <!-- Replace with dynamic data -->
                    </div>

                    <!-- Card for Boarding House Count -->
                    <div class="bg-gray-700 p-6 rounded-lg shadow-md"> <!-- Changed to p-6 for uniform padding -->
                        <h3 class="text-xl font-bold text-gray-200">Boarding House Count</h3>
                        <p class="text-2xl text-gray-100">wew</p> <!-- Replace with dynamic data -->
                    </div>

                </div>

                <!-- Graph Section -->
                <div class="bg-gray-700 p-6 rounded-lg shadow-md"> <!-- Changed to p-6 for uniform padding -->
                    <h3 class="text-xl font-bold text-gray-200">Graph</h3>
                    <div id="graph" style="height: 300px;">
                        <!-- Placeholder for graph rendering -->
                        <canvas id="myChart" height="120px"></canvas>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>