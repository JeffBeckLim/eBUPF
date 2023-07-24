<?php

use App\Http\Controllers\AdminController;
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
// Route::get('/test/test-sidebar', function () {
//     return view('admin-components.admin-layout');
// })->middleware('auth','admin.access');

// Show Admin Dashboard - NOTE MAKE OWN CONTROLLER 
Route::get('/admin/dashboard/', [AdminController::class, 'index'])->middleware('auth','admin.access')->name('admin-dashboard');


// Show Home or Landing Page
Route::get('/', function () {
    return view('home');
})->middleware('verified.access');

// Show Admin Ledger - NOTE MAKE OWN CONTROLLER 
Route::get('/ledger', function (){
    return view('admin-views.admin-ledger');
})->middleware('auth','admin.access');



// show view for non member 
Route::get('/member', function(){
    return view('member-views.member-dashboard');
})->middleware('auth','member.access')->name('member-dashboard');
// ->middleware('auth')


//auth logout flush
Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('/');
});

Auth::routes(['verify' => true]);

// Show Home Page
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified.access')->name('home');

// Test route show verify Page
// Route::get('/verify-test', function(){
//     return view('auth.verify');
// });

// routes/web.php or routes/api.php

Route::get('/test-session', function () {
    session(['test_key' => 'test_value']); // Set a value in the session for testing
    return 'Session test route';
});
