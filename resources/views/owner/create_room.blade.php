<x-owner-layout>
    @if (session()->has('message'))
<x-success-toast :message="session()->get('message')"/>
@endif
    <x-slot name="header">

        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Boarding House') }}
            </h2>

          <h1>create room</h1>

        </div>

        <form action="{{ route('room-add', $bh->id) }}" method="post" enctype="multipart/form-data" style="max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9;">
            @csrf

              <div style="margin-bottom: 15px;">
                  <label for="name" style="display: block; font-weight: bold; margin-bottom: 5px;">Name:</label>
                  <input type="text" id="name" name="name" placeholder="Enter room name" style="
                      width: 100%;
                      padding: 10px;
                      border: 1px solid #ced4da;
                      border-radius: 4px;
                      box-sizing: border-box;
                  ">
              </div>
              @error('name')
              <div class="text-sm text-red-400">{{ $message }}</div>
              @enderror

              <div style="margin-bottom: 15px;">
                  <label for="capacity" style="display: block; font-weight: bold; margin-bottom: 5px;">Capacity:</label>
                  <input type="number" id="capacity" name="capacity" placeholder="Enter room capacity" style="
                      width: 100%;
                      padding: 10px;
                      border: 1px solid #ced4da;
                      border-radius: 4px;
                      box-sizing: border-box;
                  ">
              </div>
              @error('capacity')
          <div class="text-sm text-red-400">{{ $message }}</div>
          @enderror

              <div style="margin-bottom: 15px;">
                  <label for="price" style="display: block; font-weight: bold; margin-bottom: 5px;">Price:</label>
                  <input type="number" id="price" name="price" placeholder="Enter room price" style="
                      width: 100%;
                      padding: 10px;
                      border: 1px solid #ced4da;
                      border-radius: 4px;
                      box-sizing: border-box;
                  ">
              </div>
              @error('price')
              <div class="text-sm text-red-400">{{ $message }}</div>
              @enderror
              <div style="margin-bottom: 20px;">
                  <label for="room_image_1" style="display: block; font-weight: bold; margin-bottom: 5px;">Room Image:(optional)</label>
                  <input type="file" id="room_image_1" name="room_image_1"  style="
                      padding: 8px;
                      border: 2px solid #007BFF;
                      border-radius: 4px;
                      background-color: #ffffff;
                      cursor: pointer;
                      font-size: 14px;
                      box-sizing: border-box;
                      display: block;
                      width: 100%;
                  ">
              </div>
              @error('room_image_1')
              <div class="text-sm text-red-400">{{ $message }}</div>
              @enderror

              <div style="margin-bottom: 20px;">
                <label for="room_image_2" style="display: block; font-weight: bold; margin-bottom: 5px;">Room Image:</label>
                <input type="file" id="room_image_2" name="room_image_2"  style="
                    padding: 8px;
                    border: 2px solid #007BFF;
                    border-radius: 4px;
                    background-color: #ffffff;
                    cursor: pointer;
                    font-size: 14px;
                    box-sizing: border-box;
                    display: block;
                    width: 100%;
                ">
            </div>
            @error('room_image_2')
            <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror

            <div style="margin-bottom: 20px;">
                <label for="room_image_3" style="display: block; font-weight: bold; margin-bottom: 5px;">Room Image:</label>
                <input type="file" id="room_image_3" name="room_image_3"  style="
                    padding: 8px;
                    border: 2px solid #007BFF;
                    border-radius: 4px;
                    background-color: #ffffff;
                    cursor: pointer;
                    font-size: 14px;
                    box-sizing: border-box;
                    display: block;
                    width: 100%;
                ">
            </div>
            @error('room_image_3')
            <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror

            <div style="margin-bottom: 20px;">
                <label for="room_image_3" style="display: block; font-weight: bold; margin-bottom: 5px;">Room Image:</label>
                <input type="file" id="room_image_3" name="room_image_3"  style="
                    padding: 8px;
                    border: 2px solid #007BFF;
                    border-radius: 4px;
                    background-color: #ffffff;
                    cursor: pointer;
                    font-size: 14px;
                    box-sizing: border-box;
                    display: block;
                    width: 100%;
                ">
            </div>
            @error('room_image_3')
            <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror



      <button class="btn">submit</button>

        </form>


    </x-slot>


</x-owner-layout>
