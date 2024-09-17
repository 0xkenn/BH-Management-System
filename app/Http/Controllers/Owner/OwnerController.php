<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddBoardingHouseRequest;
use App\Http\Requests\AddRoomRequest;
use App\Models\BoardingHouse;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{
    public function boardingHouse(){
        $bh = BoardingHouse::where('owner_id', Auth::guard('owner')->id())->get();

        return view('owner.boardingHouse', compact('bh'));
    }

    public function store(AddBoardingHouseRequest $request){

        $data = $request->validated();
        $data['owner_id'] = Auth::guard('owner')->id();
            if($request->hasFile('background_image') && $request->hasFile('business_permit_image')){

            $data['background_image'] = $request->file('background_image')->store('background_images', 'public');
            $data['business_permit_image'] = $request->file('business_permit_image')->store('business_permit_images', 'public');


            BoardingHouse::create($data);
                return redirect()->route('owner.boardingHouse')->with('message', 'successfully created a boarding house');
            }else{
                return redirect()->back()->withErrors('Error creating boarding house');
            }
            return redirect()->back();
    }

    public function storeRoom(AddRoomRequest $request){
        
        $data = $request->validated();
        $data['owner_id'] = Auth::guard('owner')->id();
        $data['boarding_houses_id'] = $id;
        if ($request->hasFile('room_image')) {
            $imagePaths = [];
            foreach ($request->file('room_image') as $image) {
                // Store each image and collect paths
                $imagePaths[] = $image->store('room_images', 'public');
            }
            // Save images as JSON if multiple images, or as string if one
            $data['room_image'] = json_encode($imagePaths);
            dd($data);
            Room::create($data);
            return redirect()->route('owner.boardingHouse')->with('success', 'Room created successfully');
        } else {
            return redirect()->back()->withErrors('Error: Room image is required.');
        }
    }
    
}
