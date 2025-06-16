<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Show register page
Route::get('/register', function () {
    return view('auth.register');
})->name('register.form');

// Handle registration
Route::post('/register', [AuthController::class, 'register'])->name('register');


// Show login page
Route::get('/login', function () {
    return view('auth.login');
})->name('login.form');

// Handle login
Route::post('/login', [AuthController::class, 'login'])->name('login');


//Hadle profile and logout
Route::middleware('auth')->group(function () {

    //show profile page
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

    //Handle logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});