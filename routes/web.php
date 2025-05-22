<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkingCardController;

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

Route::get('/', function () {
    return view('welcome');
});

// Reporting and Analytics route
Route::get('parking_cards/reports', [ParkingCardController::class, 'reports'])->name('parking_cards.reports');
Route::resource('parking_cards', ParkingCardController::class);
