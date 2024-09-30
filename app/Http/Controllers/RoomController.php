<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function show(){
        $room = DB::table('rooms')->paginate(6);
    }
}
 