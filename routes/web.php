<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\saveRoomController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

use App\Models\BoardingHouse;
use App\Models\Preference;
use App\Models\Room;

Route::get('/', function () {
    $boardingHouses = BoardingHouse::with('rooms')->get();
    $preferences = Preference::all();
    return view('homepage', compact( 'boardingHouses', 'preferences'));
 
    
});




Route::middleware('auth:web')->group(function () {


    Route::get('saved-boarding_house', [UserController::class, 'savedBoardingHouse'])->name('user.saved-boarding-house');
    Route::get('/dashboard', [UserController::class, 'boardingHouse'])->name('user.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/useredit/{id}', [UserController::class, 'userProfile'])->name('useredit');
    Route::get('/room-details/{id}', [UserController::class, 'roomDetails'])->name('user.room-details');
    Route::get('room-list', [UserController::class, 'roomList'])->name('room.list');
    Route::get('notifications', [UserController::class, 'notifications'])->name('notifications');
    Route::post('/save-room/{id}',[UserController::class, 'reserveRoom']);
    Route::get('reservation-list', [UserController::class, 'reservationList'])->name('reservation.list');
    Route::post('edit-user', [UserController::class, 'editProfile'])->name('user.profile.update');



});

    Route::get('/welcome', [WelcomeController::class, 'ShowWelcome'])->name('welcome');

    Route::get('/search', [SearchController::class, 'search'])->name('search');


    Route::get('/roomdetail', [UserController::class, 'roomDetail'])->name('roomdetail');
    Route::get('/notification', [UserController::class, 'roomNotif'])->name('notification');
    // roomshow
    Route::get('/rooms/{id}', [UserController::class, 'roomShow'])->name('show');




Route::get('/school/login', [SchoolController::class, 'login'])->name('school.login');
Route::post('/school/login/auth', [SchoolController::class, 'loginAuth'])->name('school.login.auth');
Route::prefix('school')->middleware('auth:school')->group(function (){
    Route::get('dashboard', [SchoolController::class, 'dashboard'])->name('school.dashboard');
    Route::post('/logout-school', [SchoolController::class, 'destroy'])->name('school.logout');
    
});

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';
require __DIR__.'/owner-auth.php';
