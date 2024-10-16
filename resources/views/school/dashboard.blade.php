<x-school-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-900 rounded-lg overflow-hidden shadow-2xl">

                <!-- Dashboard Header -->
                <div class="p-8">
                    <h2 class="text-3xl font-bold text-white mb-8">Dashboard</h2>

                    <!-- Grid for Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">

                        <!-- User Count Card -->
                        <div class="bg-gradient-to-br from-blue-500 to-purple-600 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold text-white">User Count</h3>
                                    <p class="text-5xl font-bold text-white mt-2">200</p> <!-- Dynamic data -->
                                </div>
                                <div class="text-white opacity-50">
                                    <!-- User Icon -->
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9.01 9.01 0 0112 15c2.21 0 4.21.79 5.879 2.11M15 7a3 3 0 11-6 0 3 3 0 016 0zm-3 12a9 9 0 100-18 9 9 0 000 18z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Boarding House Count Card -->
                        <div class="bg-gradient-to-br from-green-500 to-teal-600 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold text-white">Boarding House Count</h3>
                                    <p class="text-5xl font-bold text-white mt-2">50</p> <!-- Dynamic data -->
                                </div>
                                <div class="text-white opacity-50">
                                    <!-- House Icon -->
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10l1.117-.44a4.992 4.992 0 011.42-.25h14a5 5 0 011.42.25L21 10M21 10v10a1 1 0 01-1 1h-5a1 1 0 01-1-1v-5a1 1 0 00-1-1H9a1 1 0 00-1 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1V10m18-1L12 3 3 9"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Graph Section -->
                    <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                        <h3 class="text-lg font-semibold text-white mb-4">Performance Graph</h3>
                        <div class="h-64">
                            <canvas id="myChart" height="120"></canvas> <!-- Placeholder for graph -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-school-layout>
