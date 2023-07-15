<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;

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


// Show Home or Landing Page
Route::get('/', function () {
    return view('home');
});

// Show Admin Ledger
Route::get('/admin-ledger', function (){
    return view('admin-views.admin-ledger');
});

// Store Registered User
Route::post('/users', [UserController::class, 'store']);

// show view for non member 
Route::get('/new-member', function(){
    return view('member-views.non-member');
});

//auth logout flush
Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('/');
});

Auth::routes(['verify' => true]);

// Show Home Page
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Test route show verify Page
// Route::get('/verify-test', function(){
//     return view('auth.verify');
// });