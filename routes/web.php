<?php

use App\Http\Controllers\DashboardController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/countries', [CountryController::class, 'index']);
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');