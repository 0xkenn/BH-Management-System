<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditProfileRequest;
use App\Models\Room;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
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
        $regions = DB::table('philippine_regions')->select('region_code', 'region_description')->get();
        return view ("user.user-profile", compact('regions'));
    }


    public function roomDetails($id)
    {
        $room = Room::findOrFail($id);
        $savedRoom = $room->reservations()->where('user_id', auth()->guard('web')->id())->first();
        $userHasRating = $room->ratings()->where('user_id', auth()->guard('web')->id())->exists();
    
        // Pass `savedRoom` status and `isApproved` to the view
        return view('user.room-detail', [
            'room' => $room,
            'savedRoom' => $savedRoom ? true : false,
            'isApproved' => $savedRoom ? $savedRoom->is_approved : 0, // Default to 0 if no reservation exists
            'userHasRating' => $userHasRating,
        ]);
    }
    
    public function reserveRoom($id)
    {
        $room = Room::findOrFail($id);
        $userId = auth()->guard('web')->id();
        $savedRoom = $room->reservations()->where('user_id', $userId)->first();
    
        if (!is_null($savedRoom)) {
            // Delete reservation if it exists (unreserve)
            $savedRoom->delete();
            return response()->json(['savedRoom' => false, 'isApproved' => null]);
        } else {
            // Create new reservation with `is_approved` set to 0
            $savedRoom = $room->reservations()->create([
                'user_id' => $userId,
                'is_approved' => 0, // Default to pending approval
            ]);
            return response()->json(['savedRoom' => true, 'isApproved' => $savedRoom->is_approved]);
        }
    }
    
    

    public function roomList(){
        $rooms = Room::with('boarding_house')->get();   
        return view('user.room-list', compact('rooms'));
    }
    public function reservationList()
    {
        $userId = auth()->guard('web')->id();
    
        $reservedRooms = Room::whereHas('reservations', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->with(['boarding_house', 'reservations' => function ($query) use ($userId) {
            $query->where('user_id', $userId); // Load only the user's reservations for each room
        }])
        ->get();
    
        return view('user.reservation-list', compact('reservedRooms'));
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
        'profile_image' => $data['profile_image'],
        'name' => $data['name'],
        'email' => $data['email'],
        'age' => $data['age'],
        'gender' => $data['gender'],
        'mobile_number' => $data['mobile_number'],
        'is_student' => $data['is_student'],
        'region_code' => $data['region_code'],
        'province_code' => $data['province_code'],
        'city_municipality_code' => $data['city_municipality_code'],
        'barangay_code' => $data['barangay_code'],
        'password' => !empty($data['password']) ? Hash::make($data['password']) : DB::raw('password') // Only hash if a new password is provided
    ]);

            return redirect()->route('user.dashboard');
     }

public function notifications(){
    $user = auth()->guard('web')->user();
    $unreadNotifications = $user->unreadNotifications;
 return view('user.user-notification', compact('unreadNotifications'));
}
public function rateRoom(Request $request, $id)
{
    $validated = $request->validate([
        'rating' => 'required|integer|min:1|max:5',
    ]);

    $room = Room::findOrFail($id);
    $room->ratings()->create([
        'user_id' => auth()->guard('web')->id(),
        'rating' => $validated['rating'],
    ]);

    return redirect()->back()->with('message', 'Thank you for your review!');
}
}
