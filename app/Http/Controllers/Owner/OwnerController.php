<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddBoardingHouseRequest;
use App\Models\BoardingHouse;
use App\Models\Preference;
use App\Models\savedRoom;
use App\Models\User;
use App\Notifications\ReservationApproved;
use App\Notifications\ReservationRejected;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{

    public function dashboard() {
        $users = User::with(['reservations' => function ($query) {
            $query->whereHas('room', function ($query) {
                $query->where('owner_id', auth()->guard('owner')->id()); // Ensure only reservations for rooms of the authenticated owner
            });
        }])
        ->whereDoesntHave('reservations', function ($query) {
            $query->where('is_approved', 1); // Exclude users with any approved reservations
        })
        ->get();
        
 
    
    
    
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
        $preferences = Preference::all();

        // Decode JSON or handle empty values safely
    
      

        return view('owner.boardingHouse', compact('bh', 'preferences'));
    }
    public function store(Request $request){

        $data = $request->validate([
            'name' =>'required|string',
            'address' => 'required|string',
            'description' => 'required|string',
            'business_permit_image' => 'required|image|mimes:png,jpg,jpeg',
            'background_image' => 'required|image|mimes:png,jpg,jpeg,gif',
            'preferences' => 'nullable|array',
            'preferences.*' => 'exists:preferences,id', // Ensure each preference exists in the database
        ]);

        $data['owner_id'] = Auth::guard('owner')->id();

            if($request->hasFile('background_image') && $request->hasFile('business_permit_image')){
               
        
                $boardingHouse = BoardingHouse::create([
                'owner_id' => $data['owner_id'],
                'name' => $data['name'],
                'address' => $data['address'],
                'description' => $data['description'],
                'background_image' => $request->file('background_image')->store('background_images', 'public'),
                'business_permit_image' => $request->file('business_permit_image')->store('business_permit_images', 'public'),
            ]);
            $boardingHouse->preferences()->attach($data['preferences']);
            
                return redirect()->route('owner.boardingHouse')->with('message', 'successfully added a boarding house');
            }else{
                return redirect()->back()->with('errors','Error creating boarding house');
            }
            return redirect()->back();
    }

    public function approveReserve($id)
    {
        // Find the SavedRoom record with related Room data
        $savedRoom = SavedRoom::with('room')->findOrFail($id);
    
        if ($savedRoom) {
            // Delete all other reservations (approved or not) for this user, excluding the current one
            SavedRoom::where('user_id', $savedRoom->user_id)
                     ->where('id', '!=', $savedRoom->id) // Exclude the current reservation being approved
                     ->delete();
    
            // Proceed to approve the current reservation
            $savedRoom->is_approved = 1;
            $savedRoom->room->capacity -= 1; // Decrease room capacity
            $savedRoom->room->is_occupied = ($savedRoom->room->capacity === 0) ? 1 : 0; // Update occupancy status
            $savedRoom->room->save(); // Save room updates
            $savedRoom->save(); // Save the approved reservation
    
            // Notify the user about the approval
            $user = $savedRoom->user; 
            $user->notify(new ReservationApproved($savedRoom));
    
            // Redirect back with a success message
            return redirect()->back()->with('message', 'Successfully approved');
        } else {
            // If the room is already fully booked, return with an error message
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
            $user = $savedRoom->user; 
            // Save the updated room state
            $savedRoom->save();
            $savedRoom->room->save();
            $user->notify(new ReservationRejected($savedRoom));
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
    public function approvedUser(){
        $users = User::with(['reservations' => function ($query) {
            $query->whereHas('room', function ($query) {
                $query->where('owner_id', auth()->guard('owner')->id());
            });
        }])
        ->whereHas('reservations', function ($query) {
            $query->whereHas('room', function ($query) {
                $query->where('owner_id', auth()->guard('owner')->id());
            })
            ->where('is_approved', 1); // Only include approved reservations
        })
        ->get();


        return view('owner.usre-table', compact('users'));
    }   
}
