<?php

use App\Http\Controllers\ArtistInvitationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\RoleChangeRequestController;
use App\Mail\RoleChangeApproved;
use App\Repositories\RoleChangeRequestRepository;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Home');
});

Route::get('/Events',function(){
    return view('Events');
});

Route::get('/Artist',function(){
    return view('Artists');
});
// register
Route::get('/register',[AuthController::class,'showRegistrationForm']);
Route::post('/register',[AuthController::class,'register'])->name('register');
// login
Route::get('/login',[AuthController::class,'showLoginForm'])->name('login');
Route::post('/login',[AuthController::class,'login']);
//logout
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

// Change user Role
Route::post('/changeRole',[RoleChangeRequestController::class,'changeUserRole'])->name('changeRole');

//admin dashboard 
Route::get('/dashboard',[RoleChangeRequestController::class,'show'])->middleware('role:admin');
// approve changing user role by admin 
Route::post('/role-change/approve/{id}',[RoleChangeRequestController::class,'approve'])->name('role-change.approve');
Route::post('/role-change/reject/{id}',[RoleChangeRequestController::class,'rejected'])->name('role-change.rejected');

// invitation to events for the artist
Route::get('/artist/Invitation',[ArtistInvitationController::class,'show']);
// Add Event by organisateur
Route::get('/organisateur/AddEvent',[EventController::class,'showform']);

Route::post('/organisateur/registerEvent',[EventController::class,'store'])->name('registerEvent');

Route::get('/profile',function(){
    return view('profile');
})->name('profile');
Route::get('/EditProfile',function(){
    return view('EditProfile');
});
Route::get('/details',function(){
    return view('EventDetails');
});

Route::get('/users',[AuthController::class,'index']);
Route::get('/auth/google',[GoogleAuthController::class,'redirectToGoogle'])->name("redirect.google");
Route::get('/auth/google/callback',[GoogleAuthController::class,'handleGoogleCallback']);