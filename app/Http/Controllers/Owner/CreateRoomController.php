<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateRoomController extends Controller
{
    public function index(){
        return view('owner.create_room');
    }
}
