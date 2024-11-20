<x-school-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Heading -->
        <h1 class="text-3xl font-bold text-gray-900 mb-6">All Students</h1>

        <!-- Search Bar -->
        <div class="mb-4">
            <input type="text" id="searchInput" class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm" placeholder="Search students..." onkeyup="searchStudents()">
        </div>

        <!-- Table for Students -->
        <div class="overflow-hidden bg-white shadow sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200" id="studentTable">
                <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Student Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Parents
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            BoardingHouse Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Contact Number
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Address
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Program
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            School
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- Static content for students -->
                  @foreach($users as $user)
                  <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{$user->first_name}} {{$user->middle_name}} {{$user->last_name}} {{$user->suffix}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{$user->parent}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{$user->boarding_house_name}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{$user->user_mb}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Brgy. {{$user->brgy}}, {{$user->muni}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{$user->program_abbrev}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{$user->dept_abbrev}}
                        </td>
                    </tr>
                   
                  @endforeach
                    <!-- Add more student rows as needed -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function searchStudents() {
            let input = document.getElementById("searchInput");
            let filter = input.value.toLowerCase();
            let table = document.getElementById("studentTable");
            let rows = table.getElementsByTagName("tr");

            // Loop through all table rows, starting from index 1 (skip the header row)
            for (let i = 1; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName("td");
                let match = false;

                for (let j = 0; j < cells.length; j++) {
                    let cellValue = cells[j].textContent || cells[j].innerText;
                    if (cellValue.toLowerCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }

                rows[i].style.display = match ? "" : "none";
            }
        }
    </script>
</x-school-layout>
