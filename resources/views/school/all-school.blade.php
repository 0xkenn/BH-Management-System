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
                            Grade
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Status
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
                            10th Grade
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Active
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
                            9th Grade
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Inactive
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
                            11th Grade
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Active
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
                let studentName = cells[0].textContent || cells[0].innerText;
                let grade = cells[1].textContent || cells[1].innerText;
                let status = cells[2].textContent || cells[2].innerText;

                if (
                    studentName.toLowerCase().indexOf(filter) > -1 ||
                    grade.toLowerCase().indexOf(filter) > -1 ||
                    status.toLowerCase().indexOf(filter) > -1
                ) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    </script>
</x-school-layout>
