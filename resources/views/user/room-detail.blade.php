<x-app-layout>
    <div class="flex items-center justify-center p-10">
     
       <div class="max-w-5xl rounded overflow-hidden shadow-lg bg-white"> <!-- Increased width -->
        <div class="grid grid-cols-2 gap-2 p-5" >
            @if ($room->room_image_1 != null)
            <img class="w-full h-32 object-cover" src="{{asset('storage/'. $room->room_image_1)}}" alt="Card Image">
            @else
            <img class="w-full h-32 object-cover" src="https://via.placeholder.com/800x300" alt="Card Image">
            @endif
            @if ($room->room_image_2 != null)
            <img class="w-full h-32 object-cover" src="{{asset('storage/'. $room->room_image_2)}}" alt="Card Image">
            @else
            <img class="w-full h-32 object-cover" src="https://via.placeholder.com/800x300" alt="Card Image">
            @endif
            @if ($room->room_image_3 != null)
            <img class="w-full h-32 object-cover" src="{{asset('storage/'. $room->room_image_3)}}" alt="Card Image">
            @else
            <img class="w-full h-32 object-cover" src="https://via.placeholder.com/800x300" alt="Card Image">
            @endif
            @if ($room->room_image_4 != null)
            <img class="w-full h-32 object-cover" src="{{asset('storage/'. $room->room_image_4)}}" alt="Card Image">
            @else
            <img class="w-full h-32 object-cover" src="https://via.placeholder.com/800x300" alt="Card Image">
            @endif
        </div>
        <div class="px-8 py-6">
            <div class="font-bold text-2xl mb-4">{{$room->name}}</div>
            <p>Capacity: {{$room->capacity}}</p>
            <p>price: {{$room->price}}</p>
            <p>Available: {{$room->is_occupied == 0 ? 'Yes': 'No'}}</p>

        </div>
        <div class="px-8 pt-4 pb-6">
            <div class="inline-block  text-white font-bold py-3 px-6 rounded-lg text-lg" 
                    x-data="{
                            savedRoom: @js($savedRoom),
                            onHandleSavedRoom(){
                                axios.post(`/save-room/{{$room->id}}`).then( res => {
                                    this.savedRoom = res.data
                                }).catch((e) => console.log(`error is ${e.message}`) );
                            },
                    }"> 
            <button  @click="onHandleSavedRoom"
            class="text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center 'bg-blue-600 hover:bg-blue-600'"
                            :class="savedRoom ? 'bg-green-700 hover:bg-green-800 focus:ring-green-300' : 'focus:ring-blue-300 bg-blue-600 hover:bg-blue-600'">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-3.5 h3.5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                            </svg>
                            <span x-text="savedRoom ? 'Reserved' : 'Reserve Now'"></span>
        </button>
        @if (session()->has('message'))
        <x-error-toast :message="session()->get('message')"/>
    @endif
        </div>
    </div>
      
    </div>
</x-app-layout>
