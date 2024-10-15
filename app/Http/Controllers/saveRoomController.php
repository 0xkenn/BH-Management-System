<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\savedRoom;
use Illuminate\Http\Request;

class saveRoomController extends Controller
{
    public function saveRoom($id){
       $room = Room::findOrFail($id);
       $savedRoom = $room->reservations()->where('user_id', auth()->guard('web')->id())->first();
       if(!is_null($savedRoom)){
        $savedRoom->delete();
        return redirect()->back()->with('message', 'Room Reservation Removed.');
       }else{
            $savedRoom = savedRoom::create([
               
                    'user_id' => auth()->guard('web')->id(),
                
            ]);
            return $savedRoom;
       }
    }
}
