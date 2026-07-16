<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\CurrencyService;
use App\Services\WeatherService;
use App\Services\EconomyService;

class DashboardController extends Controller
{
    protected $currencyService;
    protected $weatherService;
    protected $economyService;

    public function __construct(
        CurrencyService $currencyService,
        WeatherService $weatherService,
        EconomyService $economyService
    ) {
        $this->currencyService = $currencyService;
        $this->weatherService = $weatherService;
        $this->economyService = $economyService;
    }
    private function weatherText($code)
{
}
    public function index()
    {
        // =========================
        // COUNTRY
        // =========================

        $countries = Country::orderBy('name')->get();

        $selected = request('country', 'Indonesia');

        $country = Country::where('name', $selected)->first();

        $totalCountries = Country::count();

        // =========================
        // EXCHANGE RATE
        // =========================

        $exchangeRate = $this->currencyService->getRates();

        $currencyTrend = [];

if(isset($exchangeRate['IDR'])){

    $rate = $exchangeRate['IDR'];

    $currencyTrend=[

        $rate-120,
        $rate-90,
        $rate-60,
        $rate-40,
        $rate-20,
        $rate,
        $rate+15

    ];

}

        // =========================
        // WEATHER
        // =========================

        $weather = null;
        $currentWeather = null;

        $weatherText = '-';

if($currentWeather){

    $weatherText = $this->weatherText(

        $currentWeather['weather_code']

    );

}

        if ($country) {

            $weather = $this->weatherService->getCurrentWeather(
                $country->latitude,
                $country->longitude
            );

            $currentWeather = $weather['current'] ?? null;
        }
        $weatherText = match($currentWeather['weather_code']){

0 => '☀️ Clear Sky',

1,2 => '🌤 Partly Cloudy',

3 => '☁️ Cloudy',

45,48 => '🌫 Fog',

51,53,55 => '🌦 Drizzle',

61,63,65 => '🌧 Rain',

71,73,75 => '❄️ Snow',

80,81,82 => '🌧 Heavy Rain',

95 => '⛈ Thunderstorm',

default => '🌍 Unknown'

};

        // =========================
        // ECONOMY
        // =========================

        $gdp = null;
        $inflation = null;
        $population = null;
        $currency = null;

        if ($country) {

            $gdp = $this->economyService->getIndicator(
                $country->iso2,
                'NY.GDP.MKTP.CD'
            );

            $inflation = $this->economyService->getIndicator(
                $country->iso2,
                'FP.CPI.TOTL.ZG'
            );

            $population = $this->economyService->getIndicator(
                $country->iso2,
                'SP.POP.TOTL'
            );

            $currency = $this->currencyService->getCurrencyData($country);
        }

        return view('dashboard.index', compact(

            'countries',

            'selected',

            'country',

            'totalCountries',

            'exchangeRate',

            'weather',

            'currentWeather',

            'gdp',

            'inflation',

            'population',

            'currency',

            'weatherText',

            'currencyTrend',

        ));
    }
}