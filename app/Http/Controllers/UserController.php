<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function  boardingHouse(){

        $boardingHouses = DB::table('boarding_houses')->paginate(6);
        $rooms = DB::table('rooms')->paginate(6);
        return view('user.dashboard', compact('boardingHouses', 'rooms'));
    }
    public function savedBoardingHouse(){
        return view('user.saved-event');
    }

    public function userProfile(){
        return view ("user.user-profile");
    }
}
