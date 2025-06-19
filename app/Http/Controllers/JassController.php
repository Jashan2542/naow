<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class JassController extends Controller
{
    // Show the form to create a new post
    public function create()
    {
        // Return the view that contain the post creation form
        return view('posts.create');
        }

        // Store a new post in database
        public function store(Request $request)
        {
            // Validate incoming request data
            $request->validate([
                'title' => 'required|string|max:255',
                'body'  => 'required|string',
            ]);

            // Create a new post associated with the currently authenticated user
            Auth::user()->posts()->create([
                'title' => $request->title,
                'body'  => $request->body,
            ]);

            // Redirect to the index page that lists all posts
            return redirect()->route('posts.index');
        }

        // Display a list of the logged in user's posts
        public function index()
        {
            // Retrieve all posts created by the authenticated user
            $posts = Auth::user()->posts;

            // Return the view with the user's posts
            return view('posts.index', compact('posts'));
        }
}