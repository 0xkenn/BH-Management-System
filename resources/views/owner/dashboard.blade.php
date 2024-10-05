@auth('owner')
<x-owner-layout>

    <div class="flex h-screen overflow-hidden fixed"> <!-- Main flex container to hold sidebar and content -->


        <div class="flex-1 overflow-y-auto py-5"> <!-- Make the main content scrollable -->
            <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="container pt-5 pb-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 justify-end">
                            @foreach ($bh as $bhouse)
                            <div class="flex justify-center">
                                <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full max-w-xs">
                                    <img src="{{ asset('storage/' . $bhouse->background_image) }}"
                                         class="w-full h-48 object-cover"
                                         alt="{{ $bhouse->name }}">
                                    <div class="p-4">
                                        <h5 class="font-bold text-xl text-gray-800">{{ $bhouse->name }}</h5>
                                        <p class="text-gray-600 text-sm">
                                            <i class="fas fa-map-marker-alt"></i> {{ $bhouse->address }}
                                        </p>
                                        <p class="text-gray-700 text-sm mt-2 text-justify">{{ $bhouse->description }}</p>
                                        <div class="mt-4">
                                            <button type="button" class="w-full text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center" onclick="toggleModal('editModal{{ $bhouse->id }}')">
                                                Edit Details
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Modal -->
                            <div id="editModal{{ $bhouse->id }}" class="modal hidden fixed inset-0 bg-black bg-opacity-50 z-50" style="display: none;">
                                <div class="bg-white rounded-lg shadow-lg m-auto p-6 max-w-lg mt-20">
                                    <div class="flex justify-between items-center">
                                        <h5 class="text-lg font-semibold">Edit Boarding House Details</h5>
                                        <button type="button" class="text-gray-600" onclick="toggleModal('editModal{{ $bhouse->id }}')">&times;</button>
                                    </div>
                                    <div class="mt-4">

                                            @csrf
                                            @method('PUT')
                                            <div class="mb-4">
                                                <label for="houseName" class="block text-sm font-medium text-gray-700">Name</label>
                                                <input type="text" name="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" id="houseName" value="{{ $bhouse->name }}" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="houseAddress" class="block text-sm font-medium text-gray-700">Address</label>
                                                <input type="text" name="address" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" id="houseAddress" value="{{ $bhouse->address }}" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="houseDescription" class="block text-sm font-medium text-gray-700">Description</label>
                                                <textarea name="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" id="houseDescription" rows="3" required>{{ $bhouse->description }}</textarea>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="button" class="bg-gray-300 text-gray-800 rounded-md px-4 py-2 mr-2" onclick="toggleModal('editModal{{ $bhouse->id }}')">Close</button>
                                        <button type="button" class="bg-blue-600 text-white rounded-md px-4 py-2" onclick="event.preventDefault(); this.closest('form').submit();">Save changes</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-owner-layout>
@endauth
