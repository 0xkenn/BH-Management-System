<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('auth.register');
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'age' => ['required', 'integer'],
            'gender'=>['required', 'string'],
            'mobile_number' => ['required', 'string', 'regex:/^(09|63)\d{9}$/
'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            [
                'mobile_number.regex' => 'The mobile number must start with 09 or 63 and be 11 digits long.',
                'mobile_number.digits' => 'The mobile number must be exactly 11 digits.',
                'mobile_number.numeric' => 'The mobile number must be a number.',
            ]
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'age'=>$request->age,
            'gender' => $request->gender,
            'mobile_number' => $request->mobile_number,
            'password' => Hash::make($request->password),
            
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}