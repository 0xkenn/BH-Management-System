<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function ShowWelcome()
    {
        return view('welcome'); // This matches the Blade file name
    }
}
