<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\savedRoom;
use Illuminate\Support\Facades\DB;

use function Pest\Laravel\get;

class UserController extends Controller
{
    public function  boardingHouse(){

        $boardingHouses = DB::table('boarding_houses')
        ->join('rooms', 'boarding_houses.id', '=', 'rooms.boarding_house_id')
        ->where('rooms.is_occupied', 0) // check if ther is available rooms in the bh
        ->select('boarding_houses.*') // To avoid selecting room details if unnecessary
        ->distinct() // Prevent duplicate boarding houses in case they have multiple available rooms
        ->get();
    
   
        $rooms = DB::table('rooms')->get();
        return view('user.dashboard', compact('boardingHouses', 'rooms'));
    }
    public function savedBoardingHouse(){
        return view('user.saved-event');
    }

    public function userProfile(){
        return view ("user.user-profile");
    }
<<<<<<< HEAD

    public function roomDetails($id){
        $room = Room::findOrFail($id);
        $savedRoom = $room->reservations()->where('user_id', auth()->guard('web')->id())->first();


        return view('user.room-detail', compact('room', 'savedRoom'));
    }
public function reserveRoom($id){
    $room = Room::findOrFail($id);
    $savedRoom = $room->reservations()->where('user_id', auth()->guard('web')->id())->first();
   
    if(!is_null($savedRoom)){
       $savedRoom->delete();
       return;
    }else{
        $savedRoom = $room->reservations()->create([
            'user_id' => auth()->guard('web')->id(),
        ]);
        return $savedRoom;
       }
       
    
}

    public function roomList(){
        $rooms = Room::with('boarding_house')->get();   
        return view('user.room-list', compact('rooms'));
    }
    public function notifications(){
        return view('user.user-notification');
    }
    public function reservationList(){
        $userId = auth()->guard('web')->id();
        $reservedRooms = Room::whereHas('reservations', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with('boarding_house')->get();

        return view('user.reservation-list', compact('reservedRooms'));

    }
=======
     public function roomDetail(){
        return view ("user.user-detail");
     }

     public function roomNotif(){
        return view ("user.user-notification");
     }
     public function roomShow (){
        return view('user.show');
     }
>>>>>>> 27b3d07df5c29a7d9c3325ee715eb06a85af7997
}
