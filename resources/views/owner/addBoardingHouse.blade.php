@if (session()->has('errors'))
   <x-error-toast :message="session()->get('errors')"/>
@endif



{{-- modal button --}}
<a href="#create_bh_modal"
class="flex items-center justify-center   px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
>
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="size-8">
<path strokeLinecap="round" strokeLinejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
</svg>

<span class=" ml-1">Add Boarding House</span>
</a>

{{-- modal content --}}

<div class="modal" role="dialog" id="create_bh_modal">
    <div class="modal-box">
        <a  href="#" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</a>
        <form action="{{route('add-boarding-house')}}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- name field --}}
            <label class="block text-sm mb-5">
                <span class="text-gray-700 dark:text-gray-400" for="name">Boarding House Name</span>
                <!-- focus-within sets the color for the icon when input is focused -->
                <div
                  class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400"
                >
                  <input name="name" value="{{old('name')}}" type="text"
                    class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                    placeholder="Boarding House Name"
                  />
                  @error('name')
                    <div class=" text-red-600">{{$message}}</div>
                  @enderror
                  <div
                    class="absolute inset-y-0 flex items-center ml-3 pointer-events-none"
                  >
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                  </svg>

                  </div>
                </div>
              </label>
              {{-- address field --}}
              <label class="block text-sm mb-5" for="address">
                <span class="text-gray-700 dark:text-gray-400">Address</span>
                <!-- focus-within sets the color for the icon when input is focused -->
                <div
                  class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400"
                >
                  <input type="text" name="address" value="{{old('address')}}"
                    class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                    placeholder="Boarding House Address"
                  />
                  @error('address')
                  <div class=" text-red-600">{{$message}}</div>
                @enderror
                  <div
                    class="absolute inset-y-0 flex items-center ml-3 pointer-events-none"
                  >
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                  </svg>


                  </div>
                </div>
              </label>

            {{-- DEscription --}}
            <label class="block text-sm mb-5">
                <span class="text-gray-700 dark:text-gray-400" for="description">Description</span>
                <!-- focus-within sets the color for the icon when input is focused -->
                <div
                  class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400"
                >
                  <input name="description" value="{{old('description')}}" type="text"
                    class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                    placeholder="Description"
                  />
                  @error('description')
                  <div class=" text-red-600">{{$message}}</div>
                @enderror
                  <div
                    class="absolute inset-y-0 flex items-center ml-3 pointer-events-none"
                  >
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                  </svg>


                  </div>
                </div>
              </label>
{{-- pwermit field --}}
<label class="block text-sm mb-5" for="business_permit_image">
    <span class="text-gray-700 dark:text-gray-400">Business Permit
    </span>
    <!-- focus-within sets the color for the icon when input is focused -->
    <div
      class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400"
    >
      <input name="business_permit_image" value="{{old('business_permit_image')}}"
      type="file"
        class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
        placeholder="Business permit image"
      />
      @error('business_permit_image')
      <div class=" text-red-600">{{$message}}</div>
    @enderror
      <div
        class="absolute inset-y-0 flex items-center ml-3 pointer-events-none"
      >
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
      </svg>



      </div>
    </div>
  </label>


              {{-- Background image field --}}

              <label class="block text-sm mb-5" for="background_image">
                <span class="text-gray-700 dark:text-gray-400">Background image</span>
                <!-- focus-within sets the color for the icon when input is focused -->
                <div
                  class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400"
                >
                  <input name="background_image" value="{{old('background_image')}}"
                  type="file"
                    class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                    placeholder="Background image"
                  />
                  @error('background_image')
      <div class=" text-red-600">{{$message}}</div>
    @enderror
                  <div
                    class="absolute inset-y-0 flex items-center ml-3 pointer-events-none"
                  >
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                  </svg>



                  </div>
                </div>
              </label>


            <div class="modal-action">
                <button href="#" class="btn">Yay!</a>
          </form>

      </div>

    </div>
  </div>
