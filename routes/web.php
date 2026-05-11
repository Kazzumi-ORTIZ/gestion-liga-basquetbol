<?php

use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('teams', TeamController::class);
    Route::resource('players', PlayerController::class);
    Route::resource('games', GameController::class);
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics');
});

require __DIR__.'/auth.php';