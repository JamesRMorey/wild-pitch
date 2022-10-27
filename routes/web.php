<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Controller;
use App\Http\Controllers\Frontend\PitchController;

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

Route::get('/', [Controller::class, 'WelcomeIndex'])->name('welcome.index');

Route::prefix('/pitch-up')->group(function() {
    Route::get('/', [PitchController::class, 'PitchesIndex'])->name('pitches.index');
    Route::get('/details', [PitchController::class, 'PitchDetails'])->name('pitch.details');
    Route::get('/weather-data', [PitchController::class, 'PitchWeather'])->name('pitch.weather');
});

