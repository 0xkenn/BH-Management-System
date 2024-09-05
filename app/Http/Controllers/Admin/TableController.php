<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TableController extends Controller
{
    public function approveOwner(): View{

        if(Auth::guard('admin')->check()){
        
            return view('admin.dashboard');
        }

    }

    public function editApproval($id){

       $owner =  Owner::find($id);

        if($owner){
            $owner->approved = 1;
            $owner->save();
        }
        return redirect()->back()->with('message', "$owner->name can now login");
    }
    

    

 
}
