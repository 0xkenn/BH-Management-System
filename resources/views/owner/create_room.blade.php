<x-owner-layout>
    @if (session()->has('message'))
        <x-success-toast :message="session()->get('message')" />
    @endif

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Boarding House') }}
            </h2>
            <h1>Create Room</h1>
        </div>

        <form action="{{ route('room-add', $bh->id) }}" method="post" enctype="multipart/form-data" class="max-w-lg mx-auto p-6 border border-gray-300 rounded-lg bg-white shadow-md mt-4">
            @csrf

            <div class="mb-4">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Room Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter room name" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring focus:ring-blue-500">
                @error('name')
                    <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="capacity" class="block mb-2 text-sm font-medium text-gray-900">Capacity:</label>
                <input type="number" id="capacity" name="capacity" placeholder="Enter room capacity" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring focus:ring-blue-500">
                @error('capacity')
                    <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price:</label>
                <input type="number" id="price" name="price" placeholder="Enter room price" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring focus:ring-blue-500">
                @error('price')
                    <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="room_image_1" class="block mb-2 text-sm font-medium text-gray-900">Room Image 1 (optional):</label>
                    <input type="file" id="room_image_1" name="room_image_1" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring focus:ring-blue-500">
                    <div class="mt-1 text-sm text-gray-500" id="user_avatar_help"></div>
                    @error('room_image_1')
                        <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="room_image_2" class="block mb-2 text-sm font-medium text-gray-900">Room Image 2:</label>
                    <input type="file" id="room_image_2" name="room_image_2" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring focus:ring-blue-500">
                    <div class="mt-1 text-sm text-gray-500" id="user_avatar_help"></div>
                    @error('room_image_2')
                        <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="room_image_3" class="block mb-2 text-sm font-medium text-gray-900">Room Image 3:</label>
                    <input type="file" id="room_image_3" name="room_image_3" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring focus:ring-blue-500">
                    <div class="mt-1 text-sm text-gray-500" id="user_avatar_help"></div>
                    @error('room_image_3')
                        <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="room_image_4" class="block mb-2 text-sm font-medium text-gray-900">Room Image 4:</label>
                    <input type="file" id="room_image_4" name="room_image_4" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring focus:ring-blue-500">
                    <div class="mt-1 text-sm text-gray-500" id="user_avatar_help"></div>
                    @error('room_image_4')
                        <div class="mt-1 text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="w-full py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">Submit</button>
        </form>
    </x-slot>
</x-owner-layout>
