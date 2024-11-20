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
                            Profile
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Boarding Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Contact Number
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Address
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Course
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- Static content for students -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            John Doe
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Hillview Dorm
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            +1 123 456 7890
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            123 Maple St, Cityville
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Computer Science
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900">View</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            Jane Smith
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Sunrise Residence
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            +1 987 654 3210
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            456 Oak Ave, Townsville
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Business Administration
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900">View</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            Mark Johnson
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Evergreen Lodge
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            +1 555 555 5555
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            789 Pine Rd, Metrocity
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Mechanical Engineering
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900">View</a>
                        </td>
                    </tr>
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
