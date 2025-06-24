<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminController extends Controller
{
    // Show the admin dashboard view
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Display a list of users (excluding admins)
    public function users()
    {
        // Fetch users with type 'user' only
        $users = User::where('type', 'user')->get();
        return view('admin.index', compact('users'));
    }

    // Delete a user by ID
    public function deleteUser($id)
    {
        // Find user by ID or fail
        $user = \App\Models\User::findOrFail($id);
        
        // Delete the user
        $user->delete();

        // Redirect back to users page with success message
        return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
    }
}
