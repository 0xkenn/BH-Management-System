<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolLoginRequest;
use App\Models\BoardingHouse;
use App\Models\Department;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SchoolController extends Controller
{

    public function addProgram(Request $request){

       $data =  $request->validate([
            'department_id' => ['required'],
            'program_name' => ['required', 'unique:programs,program_name' ],
            'abbrev' => ['required', 'unique:programs,abbrev'],

        ]);

        Program::create($data);

        return redirect()->back();       
    }

    public function addDepartment(Request $request){
        
        $schoolId = auth()->guard('school')->id();
        $data = $request->validate([
            'department_name' => ['required', 'unique:departments,department_name'],
            'abbrev' => ['required', 'unique:departments,abbrev'],
        ]);
        $data['school_id'] = $schoolId;
       
        Department::create($data);

        return redirect()->back();

    }
    public function dashboard(){
       
        $boardingHouses = DB::table('boarding_houses as bh')
        ->select(
            'bh.id as boarding_house_id',
            'bh.name as boarding_house_name',
            DB::raw('COUNT(DISTINCT sr.user_id) as student_count'),
            DB::raw('GROUP_CONCAT(DISTINCT u.name SEPARATOR ", ") as student_names'), // Concatenate student names
            'o.name as owner_name' // Select the owner's name
        )
        ->leftJoin('rooms as r', 'bh.id', '=', 'r.boarding_house_id')
        ->leftJoin('saved_rooms as sr', function($join) {
            $join->on('r.id', '=', 'sr.room_id')
                 ->where('sr.is_approved', 1); // Only include approved entries
        })
        ->leftJoin('users as u', 'sr.user_id', '=', 'u.id') // Join with users table
        ->leftJoin('owners as o', 'bh.owner_id', '=', 'o.id') // Join with owners table
        ->groupBy('bh.id', 'bh.name', 'o.name') // Group by owner's name
        ->get();
    
         $departments = Department::all();

        return view('school.dashboard', compact('boardingHouses', 'departments'));
    }

    public function schoolSAS(){
        $users = DB::table('users as user')
        ->join('programs as program', 'user.program_id', '=', 'program.id')
        ->join('departments as dept', 'program.department_id', '=', 'dept.id')
        ->join('saved_rooms as sr', 'user.id', '=', 'sr.user_id')
        ->join('rooms as room', 'sr.room_id', '=', 'room.id')
        ->join('boarding_houses as bh', 'room.boarding_house_id', '=', 'bh.id')
        ->join('philippine_provinces as prov', 'user.province_code', '=', 'prov.province_code')
        ->join('philippine_cities as pc', 'user.city_municipality_code', '=', 'pc.city_municipality_code')
        ->join('philippine_barangays as pb' , 'user.barangay_code', '=', 'pb.barangay_code')
        ->where('dept.abbrev', 'SAS')
        ->select(
            'user.name as user_name',         // User's name
            'user.profile_image',
            'user.mobile_number',
            'bh.name as boarding_house_name',  // Boarding house name
            'program.abbrev as program_abbrev',                       // All program fields
            'dept.abbrev as dept_abbrev',                          // All department fields
            'sr.*',                            // All saved rooms fields
            'room.*',                           // All room fields
            'pc.city_municipality_description as muni', 
            'pb.barangay_description as brgy',
            'prov.province_description as prov',
        )
        ->get();
        return view('school.sas', compact('users'));
    }
    public function schoolSCJE(){

        $users = DB::table('users as user')
        ->join('programs as program', 'user.program_id', '=', 'program.id')
        ->join('departments as dept', 'program.department_id', '=', 'dept.id')
        ->join('saved_rooms as sr', 'user.id', '=', 'sr.user_id')
        ->join('rooms as room', 'sr.room_id', '=', 'room.id')
        ->join('boarding_houses as bh', 'room.boarding_house_id', '=', 'bh.id')
        ->join('philippine_provinces as prov', 'user.province_code', '=', 'prov.province_code')
        ->join('philippine_cities as pc', 'user.city_municipality_code', '=', 'pc.city_municipality_code')
        ->join('philippine_barangays as pb' , 'user.barangay_code', '=', 'pb.barangay_code')
       
        ->select(
            'user.name as user_name',         // User's name
            'user.profile_image',
            'user.mobile_number',
            'bh.name as boarding_house_name',  // Boarding house name
            'program.abbrev as program_abbrev',                       // All program fields
            'dept.abbrev as dept_abbrev',                          // All department fields
            'sr.*',                            // All saved rooms fields
            'room.*',                           // All room fields
            'pc.city_municipality_description as muni', 
            'pb.barangay_description as brgy',
            'prov.province_description as prov',
        )
        ->get();
        return view('school.scje', compact('users'));
    }
    public function schoolSME(){
        $users = DB::table('users as user')
        ->join('programs as program', 'user.program_id', '=', 'program.id')
        ->join('departments as dept', 'program.department_id', '=', 'dept.id')
        ->join('saved_rooms as sr', 'user.id', '=', 'sr.user_id')
        ->join('rooms as room', 'sr.room_id', '=', 'room.id')
        ->join('boarding_houses as bh', 'room.boarding_house_id', '=', 'bh.id')
        ->join('philippine_provinces as prov', 'user.province_code', '=', 'prov.province_code')
        ->join('philippine_cities as pc', 'user.city_municipality_code', '=', 'pc.city_municipality_code')
        ->join('philippine_barangays as pb' , 'user.barangay_code', '=', 'pb.barangay_code')
        ->where('dept.abbrev', 'SME')
        ->select(
            'user.name as user_name',         // User's name
            'user.profile_image',
            'user.mobile_number',
            'bh.name as boarding_house_name',  // Boarding house name
            'program.abbrev as program_abbrev',                       // All program fields
            'dept.abbrev as dept_abbrev',                          // All department fields
            'sr.*',                            // All saved rooms fields
            'room.*',                           // All room fields
            'pc.city_municipality_description as muni', 
            'pb.barangay_description as brgy',
            'prov.province_description as prov',
        )
        ->get();
        return view('school.sme',compact('users'));
    }
    public function schoolSNHS(){
        $users = DB::table('users as user')
        ->join('programs as program', 'user.program_id', '=', 'program.id')
        ->join('departments as dept', 'program.department_id', '=', 'dept.id')
        ->join('saved_rooms as sr', 'user.id', '=', 'sr.user_id')
        ->join('rooms as room', 'sr.room_id', '=', 'room.id')
        ->join('boarding_houses as bh', 'room.boarding_house_id', '=', 'bh.id')
        ->join('philippine_provinces as prov', 'user.province_code', '=', 'prov.province_code')
        ->join('philippine_cities as pc', 'user.city_municipality_code', '=', 'pc.city_municipality_code')
        ->join('philippine_barangays as pb' , 'user.barangay_code', '=', 'pb.barangay_code')
        ->where('dept.abbrev', 'SNHS')
        ->select(
            'user.name as user_name',         // User's name
            'user.profile_image',
            'user.mobile_number',
            'bh.name as boarding_house_name',  // Boarding house name
            'program.abbrev as program_abbrev',                       // All program fields
            'dept.abbrev as dept_abbrev',                          // All department fields
            'sr.*',                            // All saved rooms fields
            'room.*',                           // All room fields
            'pc.city_municipality_description as muni', 
            'pb.barangay_description as brgy',
            'prov.province_description as prov',
        )
        ->get();
        return view('school.snhs', compact('users'));
    }
    public function schoolSOE(){
        $users = DB::table('users as user')
        ->join('programs as program', 'user.program_id', '=', 'program.id')
        ->join('departments as dept', 'program.department_id', '=', 'dept.id')
        ->join('saved_rooms as sr', 'user.id', '=', 'sr.user_id')
        ->join('rooms as room', 'sr.room_id', '=', 'room.id')
        ->join('boarding_houses as bh', 'room.boarding_house_id', '=', 'bh.id')
        ->join('philippine_provinces as prov', 'user.province_code', '=', 'prov.province_code')
        ->join('philippine_cities as pc', 'user.city_municipality_code', '=', 'pc.city_municipality_code')
        ->join('philippine_barangays as pb' , 'user.barangay_code', '=', 'pb.barangay_code')
        ->where('dept.abbrev', 'STCS')
        ->select(
            'user.name as user_name',         // User's name
            'user.profile_image',
            'user.mobile_number',
            'bh.name as boarding_house_name',  // Boarding house name
            'program.abbrev as program_abbrev',                       // All program fields
            'dept.abbrev as dept_abbrev',                          // All department fields
            'sr.*',                            // All saved rooms fields
            'room.*',                           // All room fields
            'pc.city_municipality_description as muni', 
            'pb.barangay_description as brgy',
            'prov.province_description as SOE',
        )
        ->get();
    }
    public function schoolSTCS(){

            $users = DB::table('users as user')
            ->join('programs as program', 'user.program_id', '=', 'program.id')
            ->join('departments as dept', 'program.department_id', '=', 'dept.id')
            ->join('saved_rooms as sr', 'user.id', '=', 'sr.user_id')
            ->join('rooms as room', 'sr.room_id', '=', 'room.id')
            ->join('boarding_houses as bh', 'room.boarding_house_id', '=', 'bh.id')
            ->join('philippine_provinces as prov', 'user.province_code', '=', 'prov.province_code')
            ->join('philippine_cities as pc', 'user.city_municipality_code', '=', 'pc.city_municipality_code')
            ->join('philippine_barangays as pb' , 'user.barangay_code', '=', 'pb.barangay_code')
            ->where('dept.abbrev', 'STCS')
            ->select(
                'user.name as user_name',         // User's name
                'user.profile_image',
                'user.mobile_number',
                'bh.name as boarding_house_name',  // Boarding house name
                'program.abbrev as program_abbrev',                       // All program fields
                'dept.abbrev as dept_abbrev',                          // All department fields
                'sr.*',                            // All saved rooms fields
                'room.*',                           // All room fields
                'pc.city_municipality_description as muni', 
                'pb.barangay_description as brgy',
                'prov.province_description as prov',
            )
            ->get();
    
   
      
        return view('school.stcs', compact('users'));
    }
    public function schoolSTED(){
        $users = DB::table('users as user')
        ->join('programs as program', 'user.program_id', '=', 'program.id')
        ->join('departments as dept', 'program.department_id', '=', 'dept.id')
        ->join('saved_rooms as sr', 'user.id', '=', 'sr.user_id')
        ->join('rooms as room', 'sr.room_id', '=', 'room.id')
        ->join('boarding_houses as bh', 'room.boarding_house_id', '=', 'bh.id')
        ->join('philippine_provinces as prov', 'user.province_code', '=', 'prov.province_code')
        ->join('philippine_cities as pc', 'user.city_municipality_code', '=', 'pc.city_municipality_code')
        ->join('philippine_barangays as pb' , 'user.barangay_code', '=', 'pb.barangay_code')
        ->where('dept.abbrev', 'STED')
        ->select(
            'user.name as user_name',         // User's name
            'user.profile_image',
            'user.mobile_number',
            'bh.name as boarding_house_name',  // Boarding house name
            'program.abbrev as program_abbrev',                       // All program fields
            'dept.abbrev as dept_abbrev',                          // All department fields
            'sr.*',                            // All saved rooms fields
            'room.*',                           // All room fields
            'pc.city_municipality_description as muni', 
            'pb.barangay_description as brgy',
            'prov.province_description as prov',
        )
        ->get();
        return view('school.sted', compact('users'));
    }


    public function login(){
     ;
        return view('school.login');
    }

    public function loginAuth(SchoolLoginRequest $request){


       $request->authenticate();
        $request->session()->regenerate();
        return redirect()->route('school.dashboard');
    
}

public function destroy(Request $request): RedirectResponse
{
    Auth::guard('school')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
}
}