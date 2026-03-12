<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Carbon;
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
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_verified' => false,
        ]);

        // Generate OTP
        $otp = rand(100000, 999999); // 6-digit OTP
        $expiresAt = Carbon::now()->addMinutes(10);
        
        $user->otp = Hash::make($otp);
        $user->otp_expires_at = $expiresAt;
        $user->save();

        event(new Registered($user));

        Auth::login($user);

        // Redirect to OTP verification page with demo OTP message
        return redirect('/verify-otp')->with('success', 'Registration successful! Your OTP is: ' . $otp . ' (Demo Mode - In production, this will be sent to your email)');
    }
}
