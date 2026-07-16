<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RiskController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PortLocationController;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\ComparisonController;
use App\Http\Controllers\DataVisualizationController;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/countries', [CountryController::class, 'index']);

Route::get('/risk-analysis', [RiskController::class, 'index'])
    ->name('risk.index');

Route::get('/weather', [WeatherController::class, 'index'])
    ->name('weather');
Route::get('/currency', [CurrencyController::class, 'index'])
    ->name('currency');

Route::get('/news', [NewsController::class, 'index'])
    ->name('news');

Route::get('/port-location', [PortLocationController::class, 'index'])
    ->name('port.index');

Route::get('/watchlist', [WatchlistController::class, 'index'])
    ->name('watchlist.index');

Route::post('/watchlist', [WatchlistController::class, 'store'])
    ->name('watchlist.store');

Route::delete('/watchlist/{id}', [WatchlistController::class, 'destroy'])
    ->name('watchlist.destroy');

Route::get('/comparison', [ComparisonController::class, 'index'])
    ->name('comparison');

Route::get('/visualization', [DataVisualizationController::class, 'index'])
    ->name('visualization.index');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','admin'])->group(function(){

    Route::get('/admin',[AdminController::class,'index'])
        ->name('admin.dashboard');

    Route::get('/admin/users',[AdminController::class,'users'])
        ->name('admin.users');

    Route::get('/admin/ports',[AdminController::class,'ports'])
        ->name('admin.ports');

    Route::get('/admin/news',[AdminController::class,'news'])
        ->name('admin.news');

});
Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])
    ->name('admin.users.destroy');
Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])
    ->name('admin.users.edit');

Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])
    ->name('admin.users.update');