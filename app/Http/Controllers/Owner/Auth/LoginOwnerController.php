<?php

namespace App\Http\Controllers\Owner\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\OwnerLoginRequest;
use App\Models\Owner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class LoginOwnerController extends Controller
{

    
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.owner-login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(OwnerLoginRequest $request): RedirectResponse
{
    // Attempt to log the user in using the 'owner' guard
    if (Auth::guard('owner')->attempt($request->only('email', 'password'))) {
        // Regenerate session to prevent session fixation
        $request->session()->regenerate();
        
        // Check if the user is approved
        $approved = DB::table('owners')->where('email', $request->email)->value('approved');
        if (!$approved) {
            Auth::guard('owner')->logout(); // Log the user out if not approved
            return redirect()->route('owner.login')->with('approval', 'Your account is not yet approved. Please contact the admin.');
        }

        return redirect()->route('owner.dashboard');
    }

    // If login fails, redirect back to the login page with an error
    return redirect()->route('owner.login')->withErrors(['email' => 'The provided credentials do not match our records.']);
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('owner')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
