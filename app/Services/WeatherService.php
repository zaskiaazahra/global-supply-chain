<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function getCurrentWeather($lat, $lon)
    {
        $response = Http::timeout(20)
            ->connectTimeout(10)
            ->get('https://api.open-meteo.com/v1/forecast', [

                'latitude' => $lat,

                'longitude' => $lon,

                'current' => 'temperature_2m,relative_humidity_2m,weather_code,wind_speed_10m',

                'daily' => 'weather_code,temperature_2m_max,temperature_2m_min',

                'timezone' => 'auto'

            ]);

        return $response->json();
    }
}