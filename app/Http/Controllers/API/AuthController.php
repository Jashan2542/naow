<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class JassController extends Controller
{
    // Handle user registration
    public function register(Request $request)
    {
        // Validate input request
        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|string|confirmed',
        ]);

        \Log::info('Register API called', $request->all());

        // Create the new user hashed password
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        // Generate token using laravel sanctum
        $token = $user->createtoken('api-token')->plainTextToken;
        
        // Return response with user and token
        return response()->json([
            'user'    => $user,
            'token'   => $token,
        ]);
    }

    // Handle user login

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
            throw ValidationException::withMessage([
                'email'    => ['Invalid email'],
            ]);
        }

        // If valid, generate a new token
        $token = $user->createToken('api-token')->plainTextToken;

        // Return user info ans token
        return response()->json([
            'user'   => $user,
            'token'  => $token,
        ]);
    }

    // Get the authenticated user's profile

    public function profile(Request $request)
    {
        return response()->json([
            'status'  => true,
            'user'    => $request->user(), // 🔐 Returns the current logged-in user
        ]);
    }

    // Logout user by deleting all their tokens
    public function logout(Request $request)
    {
        // Revoke all tokens of the logged-in user
        $request->user()->tokens()->delete();

        // Return logout message
        return response()->json(['message' => 'logged out']);
    }
}