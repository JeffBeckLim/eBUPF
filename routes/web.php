<?php

use App\Models\User;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PDFController;


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
//TESTING -----------------------------------------------------------
Route::get('/testRoute/{id}', [UserController::class, 'testRoute']);


//TESTING -----------------------------------------------------------



//ADMIN-----------------------------------------------------------------------------------------------

// Show Admin Dashboard
Route::get('/admin/dashboard/', [AdminController::class, 'index'])->middleware('auth','admin.access')->name('admin-dashboard');

//Show All Accounts View
Route::get('/admin/all-users/', [AdminController::class, 'allUsers'])->middleware('auth','admin.access');

// Show Admin Ledger
Route::get('/ledger', [AdminController::class, 'memberLedger'])->middleware('auth','admin.access');

Route::put('/admin/update-role/{user}', [UserController::class, 'updateUserRole'])->name('users.updateRole');

//ADMIN-----------------------------------------------------------------------------------------------




//show membership create form
Route::put('/member/application/{member}', [MemberController::class,'createMembership']);

//Show Membership Form
Route::get('/member/membership-form', [MemberController::class,'membershipForm']);

//Show Membership Download or Edit
Route::get('/member/membership-form/edit-download', [MemberController::class,'membershipFormEditDownload']);

//Show Membership Form for Editing
Route::get('/member/membership-form/edit', [MemberController::class,'membershipFormEdit']);


//Check Membership Application
Route::get('/member/membership-application/check/{member_id}', [MemberController::class,'checkMembershipApplication']);


// Show Home or Landing Page
Route::get('/', function () {
    return view('home');
})->middleware('verified.access');

// show view for member
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

Route::get('/generateMembershipForm/{id}',[PDFController::class,'generateMembershipForm'])->middleware('auth')->name('generateMembershipForm');
