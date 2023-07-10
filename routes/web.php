<?php

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


// Show Home or Landing Page
Route::get('/', function () {
    return view('home');
});

// Show Admin Ledger
Route::get('/admin-ledger', function (){
    return view('admin-views.admin-ledger');
});


Route::get('/header', function (){
    return view('home-components.home-layout');
});