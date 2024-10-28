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
                            <!-- Boarding House Card -->
                            <div class="bg-gray-800 p-6 rounded-lg shadow-lg" x-data="{ open: false }">
                                <h3 class="text-lg font-semibold text-white mb-4">{{ $bh->boarding_house_name }}</h3>
                                <p><strong>Boarding House owner:</strong> {{ $bh->owner_name }}</p>
                                <p class="text-white mt-2">Number of students: {{ $bh->student_count }}</p>

                                <!-- View Boarders Button -->
                                <button
                                    @click="open = true"
                                    class="mt-4 bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded">
                                    View Boarders
                                </button>

                                <!-- Modal -->
                                <div
                                    x-show="open"
                                    class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50"
                                    style="display: none;"
                                    x-transition>

                                    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                                        <h3 class="text-lg font-bold mb-4">Boarders of {{ $bh->boarding_house_name }}</h3>

                                        <ul class="list-disc list-inside space-y-2">
                                            @if ($bh->student_names)
                                            @foreach (explode(', ', $bh->student_names) as $student)
                                                <li>{{ $student }}</li>
                                            @endforeach
                                        @else
                                            <li>No students found.</li>
                                        @endif
                                        </ul>

                                        <div class="mt-6 flex justify-end">
                                            <button
                                                @click="open = false"
                                                class="bg-red-600 hover:bg-red-500 text-white px-4 py-2 rounded">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-school-layout>

<script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>
