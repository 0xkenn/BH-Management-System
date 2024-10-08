<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoardingHouse;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminController extends Controller
{

    public function dashboard(): View{
        //dashboard pala to!

        if (Auth::guard('admin')->check()) {
            $users = User::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(MIN(created_at)) as month_name")) // Use MIN(created_at)
                        ->whereYear('created_at', date('Y'))
                        ->groupBy(DB::raw("MONTH(created_at)"))
                        ->pluck('count', 'month_name');
        
            $labels = $users->keys();
            $data = $users->values();

            $users = User::all()->count(); //get user count
            $boarding_houses =BoardingHouse::all()->count();
                  
            return view('admin.dashboard', compact('labels', 'data', 'users', 'boarding_houses'));
        }
        
        
            
        }
    public function ownerScreen(): View{
        $owners = DB::table('owners')->paginate(7);
        return view('admin.owner-screen', compact('owners'));
    }

    public function destroyOwner(Owner $request, $id){
        $owner = Owner::findOrFail($id);

        $owner->hash();
        $owner->delete();

        return redirect()->back();


    }
    public function BHScreen(): View{
        $boarding_houses = BoardingHouse::with('owner')->get();
        return view('admin.bh-management',  compact('boarding_houses'));
    }

    public function userList(){ 
        $users = User::all();
        return view('admin.user-management', compact('users'));
    }

    public function reports(){
        return view('admin.reports');
    }


}
