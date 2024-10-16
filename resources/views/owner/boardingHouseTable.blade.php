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
<a href="{{route('owner.room', $bh->id)}}"
    class="items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-green-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
    aria-label="approver"
>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
</a>

<!-- Modal Section -->



          {{-- view details --}}


          <a href="#bh_data_{{$bh->id}}"
            class="items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-green-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
            aria-label="approver">

             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                 <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
             </svg>

             <div class="modal modal-bottom sm:modal-middle" role="dialog" id="bh_data_{{$bh->id}}">
                 <div class="modal-box flex flex-col bg-gray-800 text-white"> <!-- Set modal background and text color -->
                     <a href="#" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</a>
                     <h3 class="text-lg font-bold">{{$bh->name}}'s Data!</h3>
                     <p class="py-4">Name: {{$bh->name}}</p>
                     <p class="py-4">Address: {{$bh->address}}</p>
                     <p class="py-4">Description: {{$bh->description}}</p> <!-- Added description -->
                     <p class="py-4">Rooms: {{$bh->rooms->count()}}</p> <!-- Added rooms -->
                     <div class="modal-action">
                         <a href="{{ route('owner.view-rooms', $bh->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block">View Rooms</a>
                         <!-- You can add action buttons here if needed -->
                     </div>
                 </div>
             </div>
         </a>




          {{-- Approve --}}


          {{-- Delete --}}



<button data-modal-target="popup-modal" data-modal-toggle="popup-modal"  type="button">
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
  </button>

  <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                  <span class="sr-only">Close modal</span>
              </button>
              <div class="p-4 md:p-5 text-center">
                  <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                  </svg>
                  <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                  <div class="flex justify-between mx-10">
                    <form action="{{route('delete.Bh', $bh->id)}}" method="post">@csrf
                      <button data-modal-hide="popup-modal"  class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                     Yes, I'm Sure
                    </button>
                    </form>
                    <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                  </div>
              </div>
          </div>
      </div>
  </div>

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
