<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Display the logged-in user's profile along with their posts
    public function profile()
    {
        // Load the authenticated user and their related posts using Eloquent relationship
        $user = Auth::user()->load('posts');

        // Return the profile view with the user data
        return view('profile', compact('user'));
    }

    // Show the form to create a new post
    public function createPost()
    {
        // Return the Blade view for creating a post
        return view('posts.create');
    }

    // Handle the form submission to store a new post in the database
    public function storePost(Request $request)
    {
        // Validate the input data
        $request->validate([
            'title' => 'required|string|max:255', // Title is required and must be a string with max 255 chars
            'body'  => 'required|string',         // Body is required and must be a string
        ]);

        // Create a new post associated with the logged-in user
        Auth::user()->posts()->create([
            'title' => $request->title,
            'body'  => $request->body,
        ]);

        // Redirect back to profile page with a success flash message
        return redirect()->route('profile')->with('success', 'Post created successfully!');
    }
}
