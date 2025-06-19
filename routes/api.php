<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

// Public routes

// Route to handle user registration
Route::post('/register', [AuthController::class, 'register']);

// Route to handle user login and return token
Route::post('/login',    [AuthController::class, 'login']);

// Protected routes that require authentication using Sanctum
Route::middleware('auth:sanctum')->group(function () {

    // Route to get the authenticated user's profile
    Route::get('/profile', [AuthController::class, 'profile']);

    // Route to logout the user and revoke token
    Route::post('/logout', [AuthController::class, 'logout']);
});
