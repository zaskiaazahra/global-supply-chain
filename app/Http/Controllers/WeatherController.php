<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    public function index(WeatherService $weatherService)
{
    $countries = Country::orderBy('name')->get();

    $selected = request('country', 'Indonesia');

    $country = Country::where('name', $selected)->first();

    $weather = null;

    if ($country) {

        $weather = $weatherService->getCurrentWeather(
            $country->latitude,
            $country->longitude
        );

    }

    return view('weather.index', [

    'country' => $country,

    'countries' => $countries,

    'weather' => $weather['current'],

    'forecast' => $weather['daily']

]);
}
}