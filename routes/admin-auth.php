<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginAdminController;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\ChartJSController;
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
    Route::get('chart-js', [ChartJSController::class, 'index']);
    Route::get('/boarding-house/management', [AdminController::class, 'BHScreen'])->name('admin.bh-management');
    Route::get('/user/management', [AdminController::class, 'userList'])->name('admin.user-list');
    Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
    
    Route::get('/owner-panel', [AdminController::class, 'ownerScreen'])->name('admin.owner-screen');
    Route::get('/dashboard',[AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/dashboard/{owner}', [TableController::class, 'editApproval'])->name('owner.approve');

    Route::post('/delete/{id}', [AdminController::class, 'deleteOwner'])->name('delete.owner.admin');
    Route::post('/delete/bh/{id}', [AdminController::class, 'destroyBh'])->name('bh.delete.admin');
    Route::post('/delete/user/{id}', [AdminController::class, 'destroyUser'])->name('user.delete.admin');

    Route::post('logout', [LoginAdminController::class, 'destroy'])
                ->name('admin.logout')->middleware(PreventBack::class);

    Route::get('/add/school', [AdminController::class, 'addSchool'])->name('add-school.page');
    Route::post('add/school/auth', [AdminController::class, 'storeSchool'])->name('school.create.auth');

});
