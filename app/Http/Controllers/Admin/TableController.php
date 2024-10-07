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
    public function approveOwner(): View{

        if (Auth::guard('admin')->check()) {
            $users = User::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(MIN(created_at)) as month_name")) // Use MIN(created_at)
                        ->whereYear('created_at', date('Y'))
                        ->groupBy(DB::raw("MONTH(created_at)"))
                        ->pluck('count', 'month_name');
        
            $labels = $users->keys();
            $data = $users->values();
                  
            return view('admin.dashboard', compact('labels', 'data'));
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
