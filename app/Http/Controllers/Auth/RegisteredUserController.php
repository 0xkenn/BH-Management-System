<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $regions = DB::table('philippine_regions')->select('region_code', 'region_description')->get();
        $programs =  Program::all();
        return view('auth.register', compact('regions', 'programs'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request['is_student'] = filter_var($request->input('is_student'), FILTER_VALIDATE_BOOLEAN);
   
        $request->validate([
            'profile_image' => ['required','image', 'mimes:png,jpeg,jpg'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:2'],
            'last_name' => ['required', 'string', 'max:255'],
            'suffix' => ['string', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'age' => ['required', 'integer'],
            'gender' => ['required', 'string'],
            'mobile_number' => ['required', 'string', 'regex:/^(09|63)\d{9}$/'],
            'parent' => ['required', 'string'],
            'is_student' => ['required', 'boolean'],
            'program_id' => ['required'],
            'region_code' => ['required', 'string', 'max:255'],     // New validation for region
            'province_code' => ['required', 'string', 'max:255'],   // New validation for province
            'city_municipality_code' => ['required', 'string', 'max:255'],       // New validation for city
            'barangay_code' => ['required', 'string', 'max:255'],   // New validation for barangay
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
           
        ], [
            'mobile_number.regex' => 'The mobile number must start with 09 or 63 and be 11 digits long.',
        ]);

        // Create the user with validated data
        $user = User::create([
            'profile_image' => $request->file('profile_image')->store('profile_images', 'public'),
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'suffix' => $request->suffix,
            'email' => $request->email,
            'age' => $request->age,
            'gender' => $request->gender,
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'gender' => $request->gender,
            'mobile_number' => $request->mobile_number,
            'parent' => $request->parent,
            'is_student' => $request->is_student,
            'program_id' => $request->program_id,
            'region_code' => $request->region_code,         // Save region
            'province_code' => $request->province_code,     // Save province
            'city_municipality_code' => $request->city_municipality_code,             // Save city
            'barangay_code' => $request->barangay_code,     // Save barangay
            'password' => Hash::make($request->password),
           
        ]);

        event(new Registered($user));



        return redirect()->route('login');
    }
}
