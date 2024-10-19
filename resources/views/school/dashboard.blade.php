<x-school-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-900 rounded-lg overflow-hidden shadow-2xl">

                <!-- Dashboard Header -->
                <div class="p-8">
                    <h2 class="text-3xl font-bold text-white mb-8">Dashboard</h2>

                    <!-- Grid for Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">

                       @foreach ($boardingHouses as $bh)
                            <!-- Boarding House Card 1 -->
                        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                            <h3 class="text-lg font-semibold text-white mb-4">{{$bh->boarding_house_name}}</h3>
                            <p class="text-white mt-2">Number opf students: {{   $bh->student_count }}</p> <!-- Sample count -->
                        </div>
                       @endforeach

                     

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-school-layout>
