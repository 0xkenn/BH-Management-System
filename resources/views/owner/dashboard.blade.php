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
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">
            <!-- Left Box: Graph -->
            <div class="bg-white border border-gray-300 rounded shadow-lg h-64">
                <h2 class="font-semibold text-lg p-4 border-b bg-gray-100">Reservations Graph</h2>
                <div class="flex items-center justify-center h-full">
                    <canvas id="reservation-graph" height="90px"></canvas>
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
                        <th class="px-4 py-3">number</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-1 py-1">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    @foreach ($user->reservations as $reservation)
                        <tr class="bg-gray-50 dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                            <td class="px-4 py-3">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->mobile_number }}</td>
                            <td class="px-4 py-3">
                                <span class="{{ $reservation->is_approved ? 'bg-green-500  text-white' : 'bg-orange-500 text-white' }} px-2 py-1 rounded">
                                    {{ $reservation->is_approved ? 'Approved' : 'pending' }}
                                </span>
                            </td>
                           
                            <td class="px-1 py-1 flex">
                                 <form action="{{route('reserve.check', $reservation->id)}}" method="post">@csrf
                                    <button ><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                      </svg>
                                    </button>
                                 </form>
                               
                                 <form action="{{ route('reserve.delete', $reservation->id) }}" method="post">
                                    @csrf
                                    <button >
                                       delete
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
    <script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
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
            fill: false
          },
          {
            label: 'Pending Reservations',
            data: pendingData, // Use Laravel-generated pending data
            borderColor: "green",
            fill: false
          },
          {
            label: 'Approved Reservations',
            data: approvedData, // Use Laravel-generated approved data
            borderColor: "blue",
            fill: false
          }
        ]
      },
      options: {
        
        legend: { display: true }
      }
    });
</script>

</x-owner-layout>
@endauth
