<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - GSHotel Platform
|--------------------------------------------------------------------------
|
| Simple, relaxing luxury hotel portal across the Netherlands.
| No login required - explore 4 & 5 star sanctuaries and reserve instantly.
|
*/

// Public Hotel Discovery & Details
Route::get('/', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{id}', [HotelController::class, 'show'])->name('hotels.show');

// Public Guest Reservation System
Route::post('/reserve', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reserved', [ReservationController::class, 'index'])->name('reservations.index');
Route::post('/reserved/lookup', [ReservationController::class, 'lookup'])->name('reservations.lookup');
Route::delete('/reserved/{code}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
