<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ParkingPriceController;
use App\Http\Controllers\ProfileController;
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


## Guest should be able to check the parking price for given date - no registration needed
## Access to this for: guest, customer, admin
## Example: http://localhost/parking-price/price/2024-03-31/2024-04-02
Route::get('/parking-price/price/{from_date?}/{to_date?}', [ParkingPriceController::class, 'index'])->name('parking-price');

Route::get('/parking-place', function () {
    return "<h1>Parking Place GET</h1>";
})->name('parking-place');


Route::get('/booking/dashboard', function(){
    return view('booking.dashboard');
})->name('booking.dashboard');
Route::get('/booking/bookings', [BookingController::class, 'index'])->name('booking.index');
Route::get('/booking/book', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking/bookings', [BookingController::class, 'store'])->name('booking.store');
Route::delete('/booking/bookings/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');


/* -------------------------------- */
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
