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

// show admin sidebar TEST ONLY
// Route::get('/test-sidebar', function () {
//     return view('admin-components.admin-layout');
// })->middleware('auth','admin.access');


// Show Home or Landing Page
Route::get('/', function () {
    return view('home');
});

// Show Admin Ledger - NOTE MAKE OWN CONTROLLER 
Route::get('/admin/ledger', function (){
    return view('admin-views.admin-ledger');
})->middleware('auth','admin.access');

// Show Admin Dashboard - NOTE MAKE OWN CONTROLLER 
Route::get('/admin/dashboard', function (){
    return view('admin-views.admin-dashboard');
})->middleware('auth','admin.access');


// show view for non member 
Route::get('/member', function(){
    return view('member-views.member-dashboard');
})->middleware('auth','member.access');
// ->middleware('auth')


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