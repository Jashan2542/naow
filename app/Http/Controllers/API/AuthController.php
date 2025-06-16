<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Handle user registration.
    public function register(Request $request)
    {
        // Validate input requests
        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

          \Log::info('Register API called', $request->all()); // confirm API call

        //  Create the new user with hashed password
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //  Generate token using Laravel Sanctum
        $token = $user->createToken('api-token')->plainTextToken;

        //  Return response with user and token
        return response()->json([
            'user'  => $user,
            'token' => $token,
        ]);
    }

    // Handle user login.
     
    public function login(Request $request)
    {
        // Validate login input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        // If user doesn't exist or password is wrong, throw validation error
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials'],
            ]);
        }

        // If valid, generate a new token
        $token = $user->createToken('api-token')->plainTextToken;

        // Return user info and token
        return response()->json([
            'user'  => $user,
            'token' => $token,
        ]);
    }

    // Get the authenticated user's profile.
     
    public function profile(Request $request)
    {
        return response()->json([
            'status' => true,
            'user' => $request->user(), // 🔐 Returns the current logged-in user
        ]);
    }

    // Logout user by deleting all their tokens.
    public function logout(Request $request)
    {
        // Revoke all tokens of the logged-in user
        $request->user()->tokens()->delete();

        // Return logout message
        return response()->json(['message' => 'Logged out']);
    }
}
