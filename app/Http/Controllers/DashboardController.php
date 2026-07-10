<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\CurrencyService;
use App\Services\WeatherService;

class DashboardController extends Controller
{
    protected $currencyService;
    protected $weatherService;

    public function __construct(
        CurrencyService $currencyService,
        WeatherService $weatherService
    ) {
        $this->currencyService = $currencyService;
        $this->weatherService = $weatherService;
    }

    public function index()
    {
        $totalCountries = Country::count();

        $exchangeRate = $this->currencyService->getRates();

        $weather = $this->weatherService->getCurrentWeather(
            -6.2088,
            106.8456
        );

        $currentWeather = $weather['current'];

        return view('dashboard.index', compact(
            'totalCountries',
            'exchangeRate',
            'weather',
            'currentWeather'
        ));
    }
}