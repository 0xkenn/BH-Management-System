<x-school-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            

<!-- Modal toggle -->
<div class="flex space-x-4 mb-5">
    <button data-modal-target="department-modal" data-modal-toggle="department-modal" class="block text-white bg-green-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        Add Department
      </button>
    
      <button data-modal-target="program-modal" data-modal-toggle="program-modal" class="block text-white bg-green-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        Add Program
      </button>
</div>

<div id="program-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Add Program
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="program-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" method="POST" action="{{route('add.program')}}">@csrf

                    <div>
                        <label for="department_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                        <select name="department_id" id="department_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required>
                            <option value="" disabled selected>Select Department</option>
                            @foreach ($departments as $department)
                            <option value="{{$department->id}}">{{$department->department_name}}</option>
                            @endforeach
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    
                    <div>
                        <label for="program_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Program</label>
                        <input type="text" name="program_name" id="program_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Program Name" required />
                    </div>
                    <div>
                        <label for="abbrev" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Abbreviation</label>
                        <input type="text" name="abbrev" id="abbrev" placeholder="Abbreviation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                   
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                  
                </form>
            </div>
        </div>
    </div>
</div> 
  
  <!-- Main modal -->
  <div id="department-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      Add Department
                  </h3>
                  <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="department-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <div class="p-4 md:p-5">
                  <form class="space-y-4" action="{{route('add.department')}}" method="post" >@csrf
                      <div>
                          <label for="department_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                          <input type="text" name="department_name" id="department_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="department name" required />
                      </div>
                      <div>
                          <label for="abbrev" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Abbreviation</label>
                          <input type="text" name="abbrev" id="abbrev" placeholder="abbreviation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                      </div>
                   
                      <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    
                  </form>
              </div>
          </div>
      </div>
  </div> 
  
        
            
            </div>
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
                                <p><strong>Boarding Address:</strong> {{ $bh->owner_address }}</p>
                                <p><strong>Boarding House Number:</strong> {{ $bh->owner_number }}</p>
                              
                                <p class="text-white mt-2">Number of students: {{ $bh->student_count }}</p>

                                
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-school-layout>

<script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>
