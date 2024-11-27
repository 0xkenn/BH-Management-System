@auth('owner')
@if (session()->has('message'))
<x-success-toast :message="session()->get('message')"/>
@endif
@if (session()->has('error'))
<x-error-toast :message="session()->get('error')"/>
@endif

<x-owner-layout>
    <div class="container mx-auto p-6">
        <!-- Row with Two Boxes -->
        <div class="grid grid-cols-1 md:grid-cols-1 gap-8 mb-6">
            <!-- Left Box: Graph -->
            <div class="bg-white border border-gray-300 rounded shadow-lg">
                <h2 class="font-semibold text-lg p-4 border-b bg-gray-100">Reservations Graph</h2>
                <div class="flex items-center justify-center">
                    <canvas id="reservation-graph" width="400" height="90"></canvas> <!-- Smaller size -->
                </div>
            </div>
        </div>

        <h1 class="text-black font-bold mb-4">Pending Reservation List</h1>
        <!-- ListView of User Reservations -->
        <div class="bg-white border border-gray-300 shadow-lg rounded-lg p-4">

            <table class="min-w-full table-auto">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">User Name</th>
                        <th class="px-4 py-3">Number</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    @foreach ($user->reservations as $reservation)
                        <tr class="bg-gray-50 dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                            <td class="px-4 py-3">{{ $user->first_name }} {{$user->middle_name}}. {{$user->last_name}} {{$user->suffix}} </td>
                            <td class="px-4 py-3">{{ $user->mobile_number }}</td>
                            <td class="px-4 py-3">
                                <span class="{{ $reservation->is_approved ? 'bg-green-500 text-white' : 'bg-orange-500 text-white' }} px-2 py-1 rounded">
                                    {{ $reservation->is_approved ? 'Approved' : 'Pending' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 flex gap-2">
                                @if (!$reservation->is_approved) <!-- Only show approve button if not already approved -->
                                    <form action="{{ route('reserve.check', $reservation->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-green-800 text-white hover:bg-green-700 rounded-lg shadow-md">
                                            Accept
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('reserve.delete', $reservation->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white hover:bg-red-500 rounded-lg shadow-md">
                                        Reject
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
        // Labels and data from Laravel
        const labels = {{ Js::from($labels) }};
        const totalData = {{ Js::from($totalData) }};
        const pendingData = {{ Js::from($pendingData) }};
        const approvedData = {{ Js::from($approvedData) }};

        new Chart("reservation-graph", {
            type: "line",
            data: {
                labels: labels, // Use Laravel-generated labels
                datasets: [
                    {
                        label: 'Total Reservations',
                        data: totalData, // Use Laravel-generated total data
                        borderColor: "red",
                        backgroundColor: "rgba(255, 99, 132, 0.2)", // Add fill color
                        fill: true, // Fill under the line for clarity
                        borderWidth: 2
                    },
                    {
                        label: 'Pending Reservations',
                        data: pendingData, // Use Laravel-generated pending data
                        borderColor: "green",
                        backgroundColor: "rgba(75, 192, 192, 0.2)", // Add fill color
                        fill: true, // Fill under the line for clarity
                        borderWidth: 2
                    },
                    {
                        label: 'Approved Reservations',
                        data: approvedData, // Use Laravel-generated approved data
                        borderColor: "blue",
                        backgroundColor: "rgba(54, 162, 235, 0.2)", // Add fill color
                        fill: true, // Fill under the line for clarity
                        borderWidth: 2
                    }
                ]
            },
            options: {
                legend: { display: true },
                responsive: true, // Ensure responsiveness of the graph
                scales: {
                    yAxes: [{
                        ticks: { beginAtZero: true },
                        scaleLabel: {
                            display: true,
                            labelString: 'Number of Reservations'
                        }
                    }]
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel + ' Reservations';
                        }
                    }
                }
            }
        });
    </script>
</x-owner-layout>
@endauth
