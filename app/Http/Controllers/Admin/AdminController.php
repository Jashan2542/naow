<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
  // Show the admin dashboard view
public function dashboard()
{
    // Get today's and yesterday's dates
    $today = Carbon::today();
    $yesterday = Carbon::yesterday();

    // Count users registered today
    $usersToday = User::whereDate('created_at', $today)->count();

    // Count users registered yesterday
    $usersYesterday = User::whereDate('created_at', $yesterday)->count();

    // Count total users in the system
    $totalUsers = User::count();

    // Count users registered in the last 7 days
    $last7Days = User::where('created_at', '>=', Carbon::now()->subDays(7))->count();

    // Pass data to the dashboard view
    return view('admin.dashboard', compact(
        'usersToday',
        'usersYesterday',
        'totalUsers',
        'last7Days'
    ));
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
        $user = User::findOrFail($id);
        
        // Delete the user
        $user->delete();

        // Redirect back to users page with success message
        return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
    }
}
