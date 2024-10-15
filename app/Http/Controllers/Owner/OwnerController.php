<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddBoardingHouseRequest;
use App\Http\Requests\AddRoomRequest;
use App\Models\BoardingHouse;
use App\Models\Room;
use App\Models\savedRoom;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{

    public function dashboard() {
        $users = User::with('reservations')->get();
    
        // Total reservations grouped by month
        $totalReservations = SavedRoom::select(
            DB::raw("COUNT(*) as count"), 
            DB::raw("MONTHNAME(MIN(created_at)) as month_name")
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("MONTH(created_at)"))
        ->pluck('count', 'month_name');
    
        // Pending reservations grouped by month
        $pendingReservations = SavedRoom::select(
            DB::raw("COUNT(*) as count"), 
            DB::raw("MONTHNAME(MIN(created_at)) as month_name")
        )
        ->whereYear('created_at', date('Y'))
        ->where('is_approved', false)
        ->groupBy(DB::raw("MONTH(created_at)"))
        ->pluck('count', 'month_name');
    
        // Approved reservations grouped by month
        $approvedReservations = SavedRoom::select(
            DB::raw("COUNT(*) as count"), 
            DB::raw("MONTHNAME(MIN(created_at)) as month_name")
        )
        ->whereYear('created_at', date('Y'))
        ->where('is_approved', true)
        ->groupBy(DB::raw("MONTH(created_at)"))
        ->pluck('count', 'month_name');
    
        // Extract labels and data for the chart
        $labels = $totalReservations->keys(); // Get the months
        $totalData = $totalReservations->values(); // Total reservations count
        $pendingData = $pendingReservations->values(); // Pending reservations count
        $approvedData = $approvedReservations->values(); // Approved reservations count
    
        return view('owner.dashboard', compact('users', 'labels', 'totalData', 'pendingData', 'approvedData'));
    }
    

    public function boardingHouse(){
        $bh = BoardingHouse::with('rooms')->where('owner_id', Auth::guard('owner')->id())->get();

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
                return redirect()->back()->with('errors','Error creating boarding house');
            }
            return redirect()->back();
    }

    public function approveReserve($id)
{
    $savedRoom = SavedRoom::with('room')->findOrFail($id);
 
    if ($savedRoom) {
        $savedRoom->is_approved = 1;
        $savedRoom->room->capacity -= 1; // Set capacity to -1 to indicate it's reserved
        $savedRoom->room->is_occupied = ($savedRoom->room->capacity === 0) ? 1 : 0; // Set occupancy status based on capacity
        $savedRoom->room->save();
        $savedRoom->save();
        
        return redirect()->back()->with('message', 'Successfully approved');
    }else {
        return redirect()->back()->with('error', 'Room is already fully booked');
    }
}

public function deleteReserve($id)
{
    $savedRoom = SavedRoom::with('room')->findOrFail($id);
    if ($savedRoom) {
        // Check if the room was approved
        if ($savedRoom->is_approved) {
            // Increment capacity since the reservation is being deleted
            $savedRoom->room->capacity += 1;

            // Set the occupancy status if capacity is greater than 0
            if ($savedRoom->room->capacity > 0) {
                $savedRoom->room->is_occupied = 0; // Set to not occupied
            }

            // Save the updated room state
            $savedRoom->save();
            $savedRoom->room->save();
        }

        //  delete the reservation record
        $savedRoom->delete();
        
        return redirect()->back()->with('error', 'Successfully deleted');
    }
}

    public function viewRooms($id){
        $bh = BoardingHouse::with('rooms')->find($id);
        
        return view('owner.owner-room-management', compact('bh'));
    }
    
    public function deleteBH($id){
        $bh = BoardingHouse::find($id);
        if($bh){
            $bh->delete();
            return redirect()->back()->with('error', 'Successfully deleted');
        }
    }
   
}
