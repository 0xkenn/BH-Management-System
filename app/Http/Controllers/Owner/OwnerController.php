<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddBoardingHouseRequest;
use App\Models\BoardingHouse;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function boardingHouse(){
        return view('owner.boardingHouse');
    }

    public function store(AddBoardingHouseRequest $request){


            if($request->hasFile('background_image')){
                $data = $request->validated();

                $data['owner_id'] = Auth::guard('owner')->id();
                $data['background_image'] = $request->file('background_image')->store('background_images', 'public');
                BoardingHouse::create($data);
                return redirect()->back();
            }else{
                return redirect()->back()->withErrors('Error creating boarding house');
            }
            return redirect()->back();
    }
}
