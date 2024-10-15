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
        $request->validated();
        return view('school.dashboard');
    }
}
