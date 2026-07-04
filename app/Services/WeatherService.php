<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function getWeather($latitude, $longitude)
    {
        $url = "https://api.open-meteo.com/v1/forecast";

        $response = Http::get($url, [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'current' => 'temperature_2m,weather_code,wind_speed_10m,rain'
        ]);

        if ($response->successful()) {
            return $response->json()['current'];
        }

        return null;
    }
}