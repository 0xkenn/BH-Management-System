@if (session()->has('errors'))
    <x-error-toast :message="session()->get('errors')"/>
@endif

{{-- Modal Button --}}
<a href="#create_bh_modal"
   class="flex items-center justify-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green"
>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-5 h-5">
        <path strokeLinecap="round" strokeLinejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
    <span class="ml-2">Add Boarding House</span>
</a>

{{-- Modal Content --}}
<div class="modal" role="dialog" id="create_bh_modal">
    <div class="modal-box p-6 bg-white rounded-lg shadow-lg">
        <a href="#" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</a>
        <form action="{{ route('add-boarding-house') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- Name Field --}}
            <label class="block text-sm mb-3">
                <span class="text-gray-700 dark:text-gray-400">Boarding House Name</span>
                <input name="name" value="{{ old('name') }}" type="text"
                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-green-400 focus:ring focus:ring-green-400 focus:ring-opacity-50"
                       placeholder="Boarding House Name" />
                @error('name')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </label>

            {{-- Address Field --}}
            <label class="block text-sm mb-3">
                <span class="text-gray-700 dark:text-gray-400">Address</span>
                <input type="text" name="address" value="{{ old('address') }}"
                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-green-400 focus:ring focus:ring-green-400 focus:ring-opacity-50"
                       placeholder="Boarding House Address" />
                @error('address')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </label>

            {{-- Description Field --}}
            <label class="block text-sm mb-3">
                <span class="text-gray-700 dark:text-gray-400">Description</span>
                <input name="description" value="{{ old('description') }}" type="text"
                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-green-400 focus:ring focus:ring-green-400 focus:ring-opacity-50"
                       placeholder="Description" />
                @error('description')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </label>

            {{-- Business Permit Field --}}
            <label class="block text-sm mb-3">
                <span class="text-gray-700 dark:text-gray-400">Business Permit</span>
                <input name="business_permit_image" value="{{ old('business_permit_image') }}" type="file"
                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-green-400 focus:ring focus:ring-green-400 focus:ring-opacity-50" />
                @error('business_permit_image')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </label>

            {{-- Background Image Field --}}
            <label class="block text-sm mb-5">
                <span class="text-gray-700 dark:text-gray-400">Background Image</span>
                <input name="background_image" value="{{ old('background_image') }}" type="file"
                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-green-400 focus:ring focus:ring-green-400 focus:ring-opacity-50" />
                @error('background_image')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </label>

            {{-- frefs --}}
            {{-- Preferences Field --}}
<label class="block text-sm mb-3">
    <span class="text-gray-700 dark:text-gray-400">Preferences</span>
    <div class="mt-1">
        @foreach($preferences as $preference)
            <label class="inline-flex items-center mt-1">
                <input type="checkbox" name="preferences[]" value="{{ $preference->id }}" class="form-checkbox text-green-600">
                <span class="ml-2">{{ $preference->name }}</span>
            </label><br>
        @endforeach
    </div>
    @error('preferences')
        <div class="text-red-600">{{ $message }}</div>
    @enderror
</label>


            <div class="flex justify-end">
                <button type="submit" class="btn bg-green-600 hover:bg-green-700 text-white">Submit</button>
            </div>
        </form>
    </div>
</div>
