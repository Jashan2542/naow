<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// =========================
// AUTH ROUTES
// =========================

// Show the registration form
Route::get('/register', function () {
    return view('auth.register');
})->name('register.form');

// Handle user registration form submission
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Show the login form
Route::get('/login', function () {
    return view('auth.login');
})->name('login.form');

// Handle user login form submission
Route::post('/login', [AuthController::class, 'login'])->name('login');

// =========================
// AUTHENTICATED USER ROUTES
// =========================

// Routes accessible only to authenticated users
Route::middleware('auth')->group(function () {

    // Show user profile page (from AuthController)
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

    // Handle user logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// =========================
// POST MANAGEMENT ROUTES
// =========================

// Additional routes for post creation, accessible only to logged-in users
Route::middleware('auth')->group(function () {

    // Show user profile page (from UserController) — may override previous profile route
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');

    // Show the form to create a new post
    Route::get('/posts/create', [UserController::class, 'createPost'])->name('posts.create');

    // Handle submission of new post data
    Route::post('/posts/store', [UserController::class, 'storePost'])->name('posts.store');
});
