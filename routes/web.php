<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';
Route::get('/clear-session', function () {
    session()->flush(); // Clears all session data
    return "Session cleared!";
});

//Route::get('/', function () {
//    return view('welcome');
//});
//Route::get('/', function () {
//    return view('home'); // Display home.blade.php
//});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // View and edit profile
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Update profile
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Delete profile
});


// Articles Resource Routes
Route::resource('articles', ArticleController::class)->middleware('auth');

Route::get('/dashboard', function () {
    return redirect()->route('articles.index');
})->middleware(['auth'])->name('dashboard');


