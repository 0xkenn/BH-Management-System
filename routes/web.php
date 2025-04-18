<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomSearchController;
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
    $boardingHouses = BoardingHouse::with('rooms')->paginate(12);
    $preferences = Preference::all();

    return view('homepage', compact( 'boardingHouses', 'preferences'));


});

Route::get('/add/school', [AdminController::class, 'addSchool'])->name('add-school.page');
Route::post('add/school/auth', [AdminController::class, 'storeSchool'])->name('school.create.auth');




Route::middleware('auth:web')->group(function () {
    Route::post('/rate-room/{id}', [UserController::class, 'rateRoom'])->name('rate-room');

    Route::get('/motifications', [UserController::class], 'notifications')->name('notifications.show');
    Route::get('saved-boarding_house', [UserController::class, 'savedBoardingHouse'])->name('user.saved-boarding-house');
    Route::get('/dashboard', [UserController::class, 'roomList'])->name('user.dashboard');
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
    Route::get('/searc/rooms', [RoomSearchController::class, 'index'])->name('rooms.search');
});

    Route::get('/welcome', [WelcomeController::class, 'ShowWelcome'])->name('welcome');

    Route::get('/search', [SearchController::class, 'search'])->name('search');
    Route::get('/regions', [LocationController::class, 'getRegions']);
Route::get('/provinces/{regionId}', [LocationController::class, 'getProvinces']);
Route::get('/cities/{provinceId}', [LocationController::class, 'getCities']);
Route::get('/barangays/{cityId}', [LocationController::class, 'getBarangays']);


    Route::get('/roomdetail', [UserController::class, 'roomDetail'])->name('roomdetail');
    Route::get('/notification', [UserController::class, 'roomNotif'])->name('notification');
    // roomshow
    Route::get('/rooms/{id}', [UserController::class, 'roomShow'])->name('show');




Route::get('/school/login', [SchoolController::class, 'login'])->name('school.login');
Route::post('/school/login/auth', [SchoolController::class, 'loginAuth'])->name('school.login.auth');
Route::prefix('school')->middleware('auth:school')->group(function (){
    Route::get('dashboard', [SchoolController::class, 'dashboard'])->name('school.dashboard');
    Route::get('sas', [SchoolController::class, 'schoolSAS'])->name('school.sas');
    Route::get('scje', [SchoolController::class, 'schoolSCJE'])->name('school.scje');
    Route::get('sme', [SchoolController::class, 'schoolSME'])->name('school.sme');
    Route::get('snhs', [SchoolController::class, 'schoolSNHS'])->name('school.snhs');
    Route::get('soe', [SchoolController::class, 'schoolSOE'])->name('school.soe');
    Route::get('stcs', [SchoolController::class, 'schoolSTCS'])->name('school.stcs');
    Route::get('sted', [SchoolController::class, 'schoolSTED'])->name('school.sted');
    Route::get('allSchool', [SchoolController::class, 'allSchool'])->name('school.all-school');
    Route::post('/logout-school', [SchoolController::class, 'destroy'])->name('school.logout');
    Route::post('add-department', [SchoolController::class, 'addDepartment'])->name('add.department');
    Route::post('add-program', [SchoolController::class, 'addProgram'])->name('add.program');


});

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';
require __DIR__.'/owner-auth.php';
