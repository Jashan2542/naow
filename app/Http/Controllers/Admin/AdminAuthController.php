<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Show the admin login form
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Handle admin login request
    public function login(Request $request)
    {
        // Get email and password from request
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Check if the authenticated user is an admin
            if (Auth::user()->type === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            // Logout if the user is not an admin
            Auth::logout();
            return redirect('/admin/login')->withErrors([
                'email' => 'Access denied. Not an admin.',
            ]);
        }

        // If authentication fails, return with error
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    // Handle admin logout
    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}
