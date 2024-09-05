<?php

namespace App\Http\Controllers\Owner\Auth;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredOwnerController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.owner-register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
       
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Owner::class],
            'address' => ['required', 'string'],
            'mobile_number' => ['required', 'string', 'regex:/^(09|63)\d{9}$/'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        

        $owner = Owner::create([
            'id' => Hash::make($request->id),
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'mobile_number' => $request->mobile_number,
            'password' => Hash::make($request->password),
        ]);
       
        event(new Registered($owner));

        Auth::guard('owner')->login($owner);

        $approve = Auth::guard('owner')->user()->approve;


        if(!$approve){
            Auth::guard('owner')->logout();
            return redirect()->route('owner.login')->with('error',  'Your account needs admin approval before you can log in.');
        }
        return redirect(route('owner.dashboard', absolute: false));
    }
}
