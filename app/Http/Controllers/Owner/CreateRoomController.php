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
    // Show the form to create a new room for the specified boarding house
    public function index($id)
    {
        // Find the boarding house or fail if it doesn't exist
        $bh = BoardingHouse::findOrFail($id);
        return view('owner.create_room', compact('bh'));
    }

    // Store the new room in the database
    public function storeRoom(AddRoomRequest $request, $id)
    {
        // Validate and retrieve the input data
        $data = $request->validated();

        // Add the authenticated owner ID and boarding house ID
        $data['owner_id'] = Auth::guard('owner')->id();
        $data['boarding_house_id'] = $id;
        $data['vacancy'] = $request->capacity;

        // Handle image uploads
        if ($request->hasFile('room_image_1')) {
            $data['room_image_1'] = $request->file('room_image_1')->store('room_images', 'public');
        }
        if ($request->hasFile('room_image_2')) {
            $data['room_image_2'] = $request->file('room_image_2')->store('room_images', 'public');
        }
        if ($request->hasFile('room_image_3')) { // Fixed the typo from 'room_image1_3' to 'room_image_3'
            $data['room_image_3'] = $request->file('room_image_3')->store('room_images', 'public');
        }
        if ($request->hasFile('room_image_4')) { // Fixed the typo from 'room_image1_3' to 'room_image_3'
            $data['room_image_4'] = $request->file('room_image_3')->store('room_images', 'public');
        }

        // Create the new room in the database
        Room::create($data);

        // Redirect to the boarding house list with a success message
        return redirect()->route('owner.boardingHouse')->with('message', 'Room created successfully');
    }
}
