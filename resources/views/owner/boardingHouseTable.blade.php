{{-- success toast notif --}}

@if (session()->has('message'))
<x-success-toast :message="session()->get('message')"/>
@endif

{{-- end toast --}}
<div class="w-full overflow-hidden rounded-lg shadow-xs">

  <div class="w-full overflow-x-auto">

    <table class="w-full whitespace-no-wrap">

      <thead>
        <tr
          class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
        >
          <th class="px-4 py-3">Boarding House Name</th>
          <th class="px-4 py-3">Address</th>
          <th class="px-4 py-3">Date Registered</th>
          <th class="px-4 py-3">Actions</th>
        </tr>
      </thead>
      <tbody
        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
      >
     @forelse ($bh as $bh)
     <tr class="text-gray-700 dark:text-gray-400">
      <td class="px-4 py-3">
        <div class="flex items-center text-sm">
          <!-- Avatar with inset shadow -->

          <div>
            <p class="font-semibold">{{$bh->name}}</p>
            <p class="text-xs text-gray-600 dark:text-gray-400">
              boarding House
            </p>
          </div>
        </div>
      </td>
      <td class="px-4 py-3 text-sm">
      {{$bh->address}}
      </td>

      <td class="px-4 py-3 text-sm">
        {{ \Carbon\Carbon::parse($bh->created_at)->isoFormat('MMM Do YYYY') }}
      </td>

      <td class="px-4 py-3">
        <div class="flex items-center space-x-4 text-sm">




{{-- add room --}}
<a href="#add-room-{{$bh->id}}"
    class="items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
    aria-label="approver"
>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
</a>

<!-- add room  -->
<div id="add-room-{{$bh->id}}" class="modal" role="dialog">
    <div class="modal-box flex flex-col">
        <a href="#" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</a>
        <h3 class="text-lg font-bold">{{$bh->name}}'s Data!</h3>
        <p class="py-4">Name: {{$bh->name}}</p>
        <p class="py-4">Address: {{$bh->address}}</p>

        <!-- Image Upload Section -->
        <h1>Select Images to Display Filenames and Previews</h1>
      <form action="{{route('add-room')}}" method="post" enctype="multipart/form-data">
        @csrf

        <input type="text" id="name"  name="name" placeholder="Name">
        <br>
        <input type="text" id="capacity"  name="name" placeholder="Capacity">
        <br>
        <input type="text" id="price"  name="name" placeholder="Price">
        <br>
        {{-- d --}}
        <input type="file" id="room_image" name="room_image[]" accept="image/*" multiple style="
        padding: 5px;
        border: 2px solid #007BFF;
        border-radius: 5px;
        background-color: #f8f9fa;
        cursor: pointer;
        font-size: 12px;
    ">
    <button class="btn">submit</button>
      </form>
        <div id="file-info" style="margin-top: 10px;"></div>

        <script>
            const fileInfo = document.getElementById('file-info');
            const fileNames = new Set(); // To track added filenames

            document.getElementById('file-input').addEventListener('change', function(event) {
                const files = Array.from(event.target.files);

                files.forEach(file => {
                    if (!fileNames.has(file.name)) {
                        fileNames.add(file.name); // Add filename to the set

                        // Create a container for each file
                        const fileContainer = document.createElement('div');
                        fileContainer.style.marginBottom = '15px';
                        fileContainer.style.display = 'flex';
                        fileContainer.style.alignItems = 'center';
                        fileContainer.style.position = 'relative';
                        fileContainer.style.padding = '10px';
                        fileContainer.style.border = '1px solid #dee2e6';
                        fileContainer.style.borderRadius = '5px';
                        fileContainer.style.backgroundColor = '#ffffff';
                        fileContainer.style.boxShadow = '0 4px 8px rgba(0,0,0,0.1)';

                        // Create an image element for the preview
                        const imagePreview = document.createElement('img');
                        imagePreview.style.width = '80px'; // Adjust width as needed
                        imagePreview.style.height = '80px'; // Adjust height as needed
                        imagePreview.style.objectFit = 'cover';
                        imagePreview.style.marginRight = '10px';
                        imagePreview.style.borderRadius = '5px';

                        // Create a span element for the filename
                        const filename = document.createElement('span');
                        filename.textContent = file.name;
                        filename.style.flexGrow = '1'; // Allows filename to take up remaining space

                        // Create a remove button
                        const removeButton = document.createElement('button');
                        removeButton.textContent = 'X';
                        removeButton.style.backgroundColor = '#dc3545';
                        removeButton.style.color = 'white';
                        removeButton.style.border = 'none';
                        removeButton.style.borderRadius = '50%';
                        removeButton.style.width = '30px';
                        removeButton.style.height = '30px';
                        removeButton.style.textAlign = 'center';
                        removeButton.style.lineHeight = '30px';
                        removeButton.style.cursor = 'pointer';
                        removeButton.style.position = 'absolute';
                        removeButton.style.top = '10px';
                        removeButton.style.right = '10px';
                        removeButton.style.fontSize = '16px';

                        // Add event listener to the remove button
                        removeButton.addEventListener('click', function() {
                            fileContainer.remove();
                            fileNames.delete(file.name); // Remove filename from the set
                        });

                        // Read the file and set the image preview
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.src = e.target.result;
                        };
                        reader.readAsDataURL(file);

                        // Append elements to the container
                        fileContainer.appendChild(imagePreview);
                        fileContainer.appendChild(filename);
                        fileContainer.appendChild(removeButton);

                        // Append the container to the file-info div
                        fileInfo.appendChild(fileContainer);
                    }
                });
            });
        </script>
    </div>
</div>


          {{-- view details --}}


        <a href="#bh_data_{{$bh->id}}"
          class=" items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
          aria-label="approver"
        >


        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
        </svg>


          <div class="modal modal-bottom sm:modal-middle" role="dialog" id="bh_data_{{$bh->id}}">
            <div class="modal-box flex flex-col">

              <a  href="#" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</a>

              <h3 class="text-lg font-bold">{{$bh->name}}'s Data!</h3>
              <p class="py-4">Name: {{$bh->name}}</p>
              <p class="py-4">Address: {{$bh->address}}</p>
              <div class="modal-action">

              </div>
            </div>

          </div>
        </a>


          {{-- Approve --}}


          {{-- Delete --}}
          <a
          class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
          aria-label="Delete"
        >
          <svg
            class="w-5 h-5"
            aria-hidden="true"
            fill="red"
            viewBox="0 0 20 20"
          >
            <path
              fill-rule="evenodd"
              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
              clip-rule="evenodd"
            ></path>
          </svg>
        </a>
        </div>
      </td>
    </tr>
    @empty
    <tr>
        <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
            No bh found
        </td>
    </tr>
     @endforelse





      </tbody>
    </table>
  </div>
  <div
    class=" px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
  >

  </div>
</div>
