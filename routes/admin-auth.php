<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginAdminController;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Middleware\PreventBack;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredAdminController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredAdminController::class, 'store']);

    Route::get('/login', [LoginAdminController::class, 'create'])
                ->name('admin.login');

    Route::post('/admin-login', [LoginAdminController::class, 'store'])->name('admin.login.auth');

  
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::get('/owner-panel', [AdminController::class, 'ownerScreen'])->name('admin.owner-screen');
    Route::get('/dashboard',[TableController::class, 'approveOwner'])->name('admin.dashboard');
    Route::post('/dashboard/{owner}', [TableController::class, 'editApproval'])->name('owner.approve');



    Route::post('logout', [LoginAdminController::class, 'destroy'])
                ->name('admin.logout')->middleware(PreventBack::class);



    Route::delete('/delete/{id}', [AdminController::class], 'destroyOwner')->name('delete.owner');
});
