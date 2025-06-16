<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;   
use App\Models\User;                  

class AuthController extends Controller
{
    // Show the registration form
    public function showRegister()
    {
        return view('auth.register'); // Returns the Blade view
    }



    // Handle the user registration logic
    public function register(Request $request)
    {
        // Validate form inputs
        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|confirmed', // also requires 'password_confirmation'
        ]);

        // Create new user in database
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password), // hash password before saving
        ]);

        // Log in the newly registered user
        Auth::login($user);

        // Redirect to profile page
        return redirect()->route('profile');
    }


    

    // Show the login form
    public function showLogin()
    {
        return view('auth.login'); // Returns the Blade view: resources/views/auth/login.blade.php
    }



    // Handle user login logic
   public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Create Sanctum token (works even in web context)
        $user = Auth::user();
        $token = $user->createToken('web-token')->plainTextToken;

        // Store token in session (optional, for access in blade or JS)
        session(['auth_token' => $token]);

        return redirect()->route('profile')->with('success', 'Logged in successfully');
    }

    return back()->withErrors(['email' => 'Invalid Email or password']);
    }



    // Show the authenticated user's profile
    public function profile()
    {
        $user = Auth::user(); // Get current logged-in user
        return view('profile', compact('user')); // Pass user data to Blade
    }



    // Log out the current user
    public function logout(Request $request)
    {
        $user = Auth::user();
    
        // Revoke all tokens
        $user->tokens()->delete();

        Auth::logout(); // Log out the user

        // Invalidate session and regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); // Redirect to login page
    }
}
