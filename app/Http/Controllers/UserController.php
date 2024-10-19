<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditProfileRequest;
use App\Models\Room;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\get;

class UserController extends Controller
{
    public function  boardingHouse(){

        $boardingHouses = DB::table('boarding_houses as bh')
        ->join('rooms as r', 'bh.id', '=', 'r.boarding_house_id')
        ->where('r.is_occupied', 0) // Check if there are available rooms
        ->select('bh.*') // Select boarding house details
        ->distinct() // Prevent duplicate boarding houses
        ->get();
    
    // Assuming you want to get rooms for each boarding house
    $boardingHousesWithRooms = $boardingHouses->map(function ($house) {
        $house->rooms = DB::table('rooms')
            ->where('boarding_house_id', $house->id)
            ->where('is_occupied', 0) // Check for available rooms
            ->get();
        return $house;
    });
        return view('user.dashboard', compact('boardingHouses', 'boardingHousesWithRooms'));
    }
    public function savedBoardingHouse(){
        return view('user.saved-event');
    }

    public function userProfile($id){
        User::find($id);
        return view ("user.user-profile");
    }


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


     public function roomNotif(){
        return view ("user.user-notification");
     }
     public function roomShow (){
        return view('user.show');
     }
     public function editProfile(EditProfileRequest $request){
        
        $data = $request->validated();
$userId = auth()->guard('web')->id(); // Get the authenticated user's ID

DB::table('users')
    ->where('id', $userId)
    ->update([
        'name' => $data['name'],
        'email' => $data['email'],
        'age' => $data['age'],
        'gender' => $data['gender'],
        'mobile_number' => $data['mobile_number'],
        'is_student' => $data['is_student'],
        'password' => !empty($data['password']) ? Hash::make($data['password']) : DB::raw('password') // Only hash if a new password is provided
    ]);

            return redirect()->route('user.dashboard');
     }
    
}
