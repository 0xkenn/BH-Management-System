<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function  boardingHouse(){
        
        $boardingHouses = DB::table('boarding_houses')->paginate(6);

        return view('dashboard', compact('boardingHouses'));
    }
}
