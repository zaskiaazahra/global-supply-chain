<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ShipmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/countries', [CountryController::class, 'index']);
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/shipment', [ShipmentController::class,'index']);
Route::get('/shipment/create', [ShipmentController::class,'create']);
Route::post('/shipment', [ShipmentController::class,'store']);
Route::get('/shipment/{id}', [ShipmentController::class,'show']);
Route::get('/shipment/{id}/edit', [ShipmentController::class,'edit']);
Route::put('/shipment/{id}',[ShipmentController::class,'update']);
Route::delete('/shipment/{id}',[ShipmentController::class,'destroy']);
Route::get('/currency', [CurrencyController::class,'index']);
