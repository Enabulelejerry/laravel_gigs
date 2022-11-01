<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Models\Listing;
use Illuminate\Support\Facades\Route;



Route::get('/', [ListingController::class,'index']);

//show create from
Route::get('/listing/create',[ListingController::class,'create'])->middleware('auth');

// Store Listing Data
Route::post('/listing',[ListingController::class,'store'])->middleware('auth');


//show EditForm
Route::get('/listing/{listing}/edit', [ListingController::class,'edit'])->middleware('auth');

//update listing
Route::put('/listing/{listing}',[ListingController::class,'update'])->middleware('auth');

//delete listing
Route::delete('/listing/{listing}',[ListingController::class,'destroy'])->middleware('auth');
//Manage Listings

Route::get('/listings/manage',[ListingController::class,'manage'])->middleware('auth');

//single listing
Route::get('/listing/{listing}',[ListingController::class,'show']);

//Show Register/Create Form

Route::get('/register', [UserController::class,'create'])->middleware('guest');

// Create New User
Route::post('/users',[UserController::class,'store']);

// Log user Out
Route::post('/logout',[UserController::class,'logout']);

// show Login Form

Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');

// Log in User
Route::post('/users/authenticate',[UserController::class,'authenticate']);

