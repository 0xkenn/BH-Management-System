<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddRoomRequest;
use App\Models\BoardingHouse;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateRoomController extends Controller
{
    public function index($id){

        $bh = BoardingHouse::findOrFail($id);
        return view('owner.create_room', compact('bh'));
    }

    public function storeRoom(AddRoomRequest $request, $id){
        
        $data = $request->validated();
        $data['owner_id'] = Auth::guard('owner')->id();
        $data['boarding_house_id'] = $id;
          if($request->hasFile('room_image_1')){
            $data['room_image_1'] = $request->file('room_image_1')->store('room_images', 'public');
          }
          if($request->hasFile('room_image_2')){
            $data['room_image_2'] = $request->file('room_image_2')->store('room_images', 'public');
          }
          if($request->hasFile('room_image1_3')){
            $data['room_image_3'] = $request->file('room_image_3')->store('room_images', 'public');
          }

            Room::create($data);
            return redirect()->route('owner.boardingHouse')->with('message', 'Room created successfully');
     
            
        
        return redirect()->back();
    }
}
