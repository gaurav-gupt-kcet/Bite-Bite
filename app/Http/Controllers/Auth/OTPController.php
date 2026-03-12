<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class OTPController extends Controller
{
    // Generate and store OTP
    public function generateOTP($user)
    {
        $otp = rand(100000, 999999); // 6-digit OTP
        $expiresAt = Carbon::now()->addMinutes(10); // OTP valid for 10 minutes
        
        $user->otp = Hash::make($otp);
        $user->otp_expires_at = $expiresAt;
        $user->save();
        
        // For demo purposes, we'll return the plain OTP
        // In production, you would send this via SMS/Email
        return $otp;
    }
    
    // Show OTP verification page
    public function showVerifyPage()
    {
        return view('auth.verify-otp');
    }
    
    // Verify OTP
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);
        
        $user = Auth::user();
        
        if (!$user) {
            return redirect('/login')->with('error', 'Session expired. Please login again.');
        }
        
        // Check if OTP is expired
        if ($user->otp_expires_at && Carbon::now()->gt($user->otp_expires_at)) {
            return back()->with('error', 'OTP has expired. Please request a new one.');
        }
        
        // Verify OTP
        if (Hash::check($request->otp, $user->otp)) {
            // OTP is correct
            $user->is_verified = true;
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();
            
            return redirect('/')->with('success', 'Your account has been verified successfully!');
        }
        
        return back()->with('error', 'Invalid OTP. Please try again.');
    }
    
    // Resend OTP
    public function resend()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect('/login')->with('error', 'Session expired. Please login again.');
        }
        
        if ($user->is_verified) {
            return redirect('/')->with('success', 'Your account is already verified.');
        }
        
        $otp = $this->generateOTP($user);
        
        return back()->with('success', 'New OTP has been generated. Your OTP is: ' . $otp . ' (Demo mode)');
    }
}