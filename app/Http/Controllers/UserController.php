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

        $boardingHouses = DB::table('boarding_houses')
        ->join('rooms', 'boarding_houses.id', '=', 'rooms.boarding_house_id')
        ->where('rooms.is_occupied', 0) // check if ther is available rooms in the bh
        ->select('boarding_houses.*') // To avoid selecting room details if unnecessary
        ->distinct() // Prevent duplicate boarding houses in case they have multiple available rooms
        ->get();
    
        $user = auth()->guard('web')->id();
        $rooms = DB::table('rooms')->get();
        return view('user.dashboard', compact('boardingHouses', 'rooms', 'user'));
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
            $user = auth()->guard('web')->user();

            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->age = $data['age'];
            $user->gender = $data['gender'];
            $user->mobile_number =$data['mobile_number'];
            $user->is_student = $data['is_student'];

            if (isset($data['password'])) {
                $user->password = Hash::make($data['password']);
            }

            
            
            
            return redirect()->route('user.dashboard');
     }
    
}
