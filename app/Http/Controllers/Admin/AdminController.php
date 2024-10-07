<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminController extends Controller
{
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
        return view('admin.bh-management');
    }

    public function userList(){
        return view('admin.user-management');
    }

    public function reports(){
        return view('admin.reports');
    }


}
