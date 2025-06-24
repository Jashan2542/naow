<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;

// =========================
// AUTH ROUTES (User Side)
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

// Routes accessible only to authenticated users
Route::middleware('auth')->group(function () {

    // Show user profile page (from UserController) — may override previous profile route
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');

    // Show the form to create a new post
    Route::get('/posts/create', [UserController::class, 'createPost'])->name('posts.create');

    // Handle submission of new post data
    Route::post('/posts/store', [UserController::class, 'storePost'])->name('posts.store');
});

// =========================
// ADMIN AUTH ROUTES
// =========================

// Admin login/logout routes
Route::middleware('web')->prefix('admin')->group(function () {
    // Show admin login form
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');

    // Handle admin login
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    // Handle admin logout
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

// =========================
// ADMIN PROTECTED ROUTES
// =========================

// Admin-only routes (requires authentication)
Route::middleware('auth')->prefix('admin')->group(function () {

    // Show admin dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Show user management page for admin
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');

    // Delete user by ID
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
});
