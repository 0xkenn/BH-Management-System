<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddBoardingHouseRequest;
use App\Models\BoardingHouse;
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
            if($request->hasFile('background_image')){

            $data['background_image'] = $request->file('background_image')->store('background_images', 'public');

            
            BoardingHouse::create($data);
                return redirect()->route('owner.boardingHouse');
            }else{
                return redirect()->back()->withErrors('Error creating boarding house');
            }
            return redirect()->back();
    }
}
