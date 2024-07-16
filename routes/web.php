<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Models\Listings;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// All listings
Route::get('/', [ListingController::class, 'index']);

// Create new listing
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');


// Store new listing
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');


// Show Edit listing
Route::get('/listings/{listing}/edit',[ListingController::class,'edit'])->middleware('auth');

// Update Listing data
Route::put('/listings/{listing}',[ListingController::class,'update'])->middleware('auth');

// Delete Listing data
Route::delete('/listings/{listing}',[ListingController::class,'destroy'])->middleware('auth');

// Manage Listings
Route::get('/listings/manage',[ListingController::class,'manage'])->middleware('auth');

// Single listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);


// Show Register/Create form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// create new user
Route::post('/users',[UserController::class,'store']);

// logout the user
Route::post('/logout', [UserController::class, 'logout']);

// show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// login user
Route::post('/users/authenticate',[UserController::class,'authenticate']);