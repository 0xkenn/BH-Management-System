@auth('admin')
<x-admin-layout>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-3">
                    <h2 class="text-lg font-semibold">Dashboard</h2>

                    <!-- Container for two rows of cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                        <!-- Card for User Count -->
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                            <h3 class="text-xl font-bold">User Count</h3>
                            <p class="text-2xl">{{$users}}</p> <!-- Replace with dynamic data -->
                        </div>

                        <!-- Card for Building Height (BH) Count -->
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                            <h3 class="text-xl font-bold">Boarding House Count</h3>
                            <p class="text-2xl">{{$boarding_houses}}</p> <!-- Replace with dynamic data -->
                        </div>

                    </div>

                    <!-- Graph Section -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold">Graph</h3>
                        <div id="graph" style="height: 300px;">
                            <!-- Placeholder for graph rendering -->
                            <canvas id="myChart" height="120px"></canvas>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
  
        var labels =  {{ Js::from($labels) }};
        var users =  {{ Js::from($data) }};
    
        const data = {
          labels: labels,
          datasets: [{
            label: 'Number of Users',
            backgroundColor: 'rgb(99, 255, 132)',
            borderColor: 'rgb(99, 255, 132)',
            data: users,
          }]
        };
    
        const config = {
          type: 'bar',
          data: data,
          options: {}
        };
    
        const myChart = new Chart(
          document.getElementById('myChart'),
          config
        );
    
  </script>
</x-admin-layout>
@endauth
