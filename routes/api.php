<?php

use App\Http\Controllers\CreateMeterController;
use App\Http\Controllers\CreateMeterReadingController;
use App\Http\Controllers\GetMeterController;
use App\Http\Controllers\GetMeterReadingsController;
use App\Http\Controllers\GetRatesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::name('user.')->group(function () {
    Route::post('/register', RegisterController::class)->name('register');
    Route::post('/login', LoginController::class)->name('login');

    Route::get('/rates', GetRatesController::class)->name('rates.get');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/meter', CreateMeterController::class)->name('meter.create');
        Route::get('/meter', GetMeterController::class)->name('meter.get');
        Route::post('/meter/readings', CreateMeterReadingController::class)->name('meter.read');
        Route::get('/meter/readings', GetMeterReadingsController::class)->name('meter.readings');
        Route::post('/logout', LogoutController::class)->name('logout');
    });
});
