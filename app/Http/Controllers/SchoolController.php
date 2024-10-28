<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolLoginRequest;
use App\Models\BoardingHouse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SchoolController extends Controller
{
    public function dashboard(){
       

       

      

        $boardingHouses = DB::table('boarding_houses as bh')
        ->select(
            'bh.id as boarding_house_id',
            'bh.name as boarding_house_name',
            DB::raw('COUNT(DISTINCT sr.user_id) as student_count'),
            DB::raw('GROUP_CONCAT(DISTINCT u.name SEPARATOR ", ") as student_names'), // Concatenate student names
            'o.name as owner_name' // Select the owner's name
        )
        ->leftJoin('rooms as r', 'bh.id', '=', 'r.boarding_house_id')
        ->leftJoin('saved_rooms as sr', function($join) {
            $join->on('r.id', '=', 'sr.room_id')
                 ->where('sr.is_approved', 1); // Only include approved entries
        })
        ->leftJoin('users as u', 'sr.user_id', '=', 'u.id') // Join with users table
        ->leftJoin('owners as o', 'bh.owner_id', '=', 'o.id') // Join with owners table
        ->groupBy('bh.id', 'bh.name', 'o.name') // Group by owner's name
        ->get();
    
    

    
     



    
        return view('school.dashboard', compact('boardingHouses'));
    }
    public function login(){
        return view('school.login');
    }

    public function loginAuth(SchoolLoginRequest $request){
       $request->authenticate();
    
       if(auth()->guard('school')->attempt(['school_name' => $request['school_name'], 'password' => $request['password']])){
        $request->session()->regenerate();
        return redirect()->route('school.dashboard');
    }
}

public function destroy(Request $request): RedirectResponse
{
    Auth::guard('school')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
}
}