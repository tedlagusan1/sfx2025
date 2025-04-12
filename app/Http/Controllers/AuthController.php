<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Invalid email or password.');
        }

        if (!$user->email_validated_at) {
            return back()->with('error', 'Please verify your email address before logging in.');
        }

        $login = Auth::attempt($request->only('email', 'password'));

        if ($login) {
            return redirect('/products');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    public function registrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Generate a verification token
        $token = Str::random(64);

        // Create the user
        $user = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'designation' => $request->designation,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verification_token' => $token,
        ]);

        // Send the verification email
        Mail::send('emails.verify', ['token' => $token, 'user' => $user], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Verify Your Email Address');
        });

        // Redirect to login page with success message
        return redirect('/login')
            ->with('success', 'Registration successful! Please check your email to verify your account before logging in.');
    }

    public function verifyEmail($token)
    {
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return redirect('/login')->with('error', 'Invalid verification token.');
        }

        $user->email_verified_at = now();
        $user->email_validated_at = Carbon::now();
        $user->email_verification_token = null;
        $user->save();

        return redirect('/login')->with('success', 'Email verified successfully! You can now login.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
