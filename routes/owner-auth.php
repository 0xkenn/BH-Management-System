<?php

use App\Http\Controllers\Owner\Auth\LoginOwnerController;
use App\Http\Controllers\Owner\Auth\RegisteredOwnerController;
use App\Http\Controllers\Owner\OwnerController;
use App\Http\Middleware\PreventBack;
use Illuminate\Support\Facades\Route;

Route::prefix('owner')->middleware('guest:owner')->group(function () {
    Route::get('register', [RegisteredOwnerController::class, 'create'])
                ->name('owner.register');

    Route::post('register', [RegisteredOwnerController::class, 'store'])->name('register-owner.store');

    Route::get('/login', [LoginOwnerController::class, 'create'])
                ->name('owner.login');

    Route::post('/owner-login', [LoginOwnerController::class, 'store'])->name('login-owner.store');

  
});

Route::prefix('owner')->middleware('auth:owner')->group(function () {

    Route::get('/dashboard', function () {
        return view('owner.dashboard');
    })->name('owner.dashboard');


   
        Route::get('/boarding-house', [OwnerController::class, 'boardingHouse'])->name('owner.boardingHouse');
        Route::get('/add-bh', [OwnerController::class, 'store'])->name('add-boarding-house');

    Route::post('logout', [LoginOwnerController::class, 'destroy'])
                ->name('owner.logout')->middleware(PreventBack::class);
});
