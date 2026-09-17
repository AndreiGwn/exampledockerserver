<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\OwnerHotelController;
use App\Http\Controllers\OwnerRoomController;
use App\Http\Controllers\ProfileController;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Hotel Trivago Platform
|--------------------------------------------------------------------------
*/

// Public Hotel Search & Details (Trivago-like discovery)
Route::get('/', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{id}', [HotelController::class, 'show'])->name('hotels.show');

// Eigenaar Dashboard
Route::get('/dashboard', function () {
    $userId = (int) Auth::id();
    $hotelModel = app(Hotel::class);
    $hotels = $hotelModel->getByOwnerId($userId);
    $totalHotels = count($hotels);
    $totalRooms = collect($hotels)->sum('rooms_count');

    return view('dashboard', [
        'hotels' => $hotels,
        'totalHotels' => $totalHotels,
        'totalRooms' => $totalRooms,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated Eigenaar Management Routes
Route::middleware('auth')->prefix('owner')->name('owner.')->group(function () {
    // Hotel Management
    Route::get('/hotels', [OwnerHotelController::class, 'index'])->name('hotels.index');
    Route::get('/hotels/create', [OwnerHotelController::class, 'create'])->name('hotels.create');
    Route::post('/hotels', [OwnerHotelController::class, 'store'])->name('hotels.store');
    Route::get('/hotels/{id}/edit', [OwnerHotelController::class, 'edit'])->name('hotels.edit');
    Route::put('/hotels/{id}', [OwnerHotelController::class, 'update'])->name('hotels.update');
    Route::delete('/hotels/{id}', [OwnerHotelController::class, 'destroy'])->name('hotels.destroy');

    // Room Management
    Route::get('/hotels/{hotelId}/rooms', [OwnerRoomController::class, 'index'])->name('rooms.index');
    Route::get('/hotels/{hotelId}/rooms/create', [OwnerRoomController::class, 'create'])->name('rooms.create');
    Route::post('/hotels/{hotelId}/rooms', [OwnerRoomController::class, 'store'])->name('rooms.store');
    Route::get('/hotels/{hotelId}/rooms/{roomId}/edit', [OwnerRoomController::class, 'edit'])->name('rooms.edit');
    Route::put('/hotels/{hotelId}/rooms/{roomId}', [OwnerRoomController::class, 'update'])->name('rooms.update');
    Route::delete('/hotels/{hotelId}/rooms/{roomId}', [OwnerRoomController::class, 'destroy'])->name('rooms.destroy');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
