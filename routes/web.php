<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

use App\Models\BoardingHouse;

Route::get('/', function () {
    return view('homepage');
});


Route::middleware('auth:web')->group(function () {

    Route::get('/dashboard', [UserController::class, 'boardingHouse'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    Route::get('/welcome', [WelcomeController::class, 'ShowWelcome'])->name('welcome');

    Route::get('/search', [SearchController::class, 'search'])->name('search');



    Route::get('/', function () {
        $boardingHouses = BoardingHouse::all();
        return view('homepage', ['boardingHouses' => $boardingHouses]);
    })->name('homepage');

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';
require __DIR__.'/owner-auth.php';
