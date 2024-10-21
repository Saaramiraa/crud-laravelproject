<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Route for the dashboard, requires authentication and email verification
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Protected routes for user profiles
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource route for authors (requires authentication)
    Route::resource('authors', AuthorController::class);
});

// Include authentication routes
require __DIR__.'/auth.php';