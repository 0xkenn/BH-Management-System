<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TableController extends Controller
{
    

    

    public function editApproval($id){

       $owner =  Owner::find($id);

        if($owner){
            $owner->approved = 1;
            $owner->save();
        }
        return redirect()->back()->with('message', "$owner->name can now login");
    }
    

    

 
}
