<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolLoginRequest;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function dashboard(){
        return view('school.dashboard');
    }
    public function login(){
        return view('school.login');
    }

    public function loginAuth(SchoolLoginRequest $request){
       $request->authenticate();
    
       if(auth()->guard('school')->attempt(['school_name' => $request['school_name'], 'password' => $request['password']])){
        $request->session()->regenerate();
        return redirect()->route('school.dashboard');
    }
}
}