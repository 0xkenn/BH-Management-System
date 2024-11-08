<?php

use App\Http\Controllers\Owner\Auth\LoginOwnerController;
use App\Http\Controllers\Owner\Auth\RegisteredOwnerController;
use App\Http\Controllers\Owner\CreateRoomController;
use App\Http\Controllers\Owner\OwnerController;
use App\Http\Middleware\PreventBack;
use Illuminate\Support\Facades\Route;

Route::prefix('owner')->middleware('guest:owner')->group(function () {
    Route::get('register', [RegisteredOwnerController::class, 'create'])
                ->name('owner.register');

    Route::post('register', [RegisteredOwnerController::class, 'store'])->name('register-owner.store');

    Route::get('/login', [LoginOwnerController::class, 'create'])
                ->name('owner.login');

    Route::post('/login/store', [LoginOwnerController::class, 'store'])->name('login-owner.store');

  
});

Route::prefix('owner')->middleware('auth:owner')->group(function () {

        Route::get('/dashboard',[OwnerController::class, 'dashboard'])->name('owner.dashboard');
        Route::get('user-table', [OwnerController::class, 'approvedUser'])->name('user-manage.table');
        Route::get('/room/{id}', [CreateRoomController::class, 'index'])->name('owner.room');
        Route::get('/boarding-house', [OwnerController::class, 'boardingHouse'])->name('owner.boardingHouse');
        Route::post('/add-bh', [OwnerController::class, 'store'])->name('add-boarding-house');
        Route::post('/add-room/{id}', [CreateRoomController::class, 'storeRoom'])->name('room-add');
        Route::post('/approve/{id}',[OwnerController::class, 'approveReserve'])->name('reserve.check');
        Route::post('/delete/reserve/{id}',[OwnerController::class, 'deleteReserve'])->name('reserve.delete');
        Route::get('/rooms/{id}', [OwnerController::class, 'viewRooms'])->name('owner.view-rooms');
        Route::post('logout', [LoginOwnerController::class, 'destroy'])->name('owner.logout')->middleware(PreventBack::class);
        Route::post('/delete/{id}', [OwnerController::class, 'deleteBH'])->name('delete.Bh');
});
