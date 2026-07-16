<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DataVisualizationService
{
    public function getGDPTrend($countryCode)
    {
        $url = "https://api.worldbank.org/v2/country/{$countryCode}/indicator/NY.GDP.MKTP.CD?format=json&per_page=7";

        $response = Http::get($url);

        if(!$response->successful()){
            return [];
        }

        $data = $response->json()[1] ?? [];

        return collect($data)
            ->sortBy('date')
            ->pluck('value')
            ->map(fn($v)=>$v ? round($v/1000000000000,2) : 0)
            ->values();
    }

    public function getInflationTrend($countryCode)
    {
        $url = "https://api.worldbank.org/v2/country/{$countryCode}/indicator/FP.CPI.TOTL.ZG?format=json&per_page=7";

        $response = Http::get($url);

        if(!$response->successful()){
            return [];
        }

        $data = $response->json()[1] ?? [];

        return collect($data)
            ->sortBy('date')
            ->pluck('value')
            ->map(fn($v)=>$v ? round($v,2) : 0)
            ->values();
    }
    public function getCurrencyTrend($currencyCode)
{
    $rates = app(\App\Services\CurrencyService::class)->getRates();

    if(
        !$currencyCode ||
        !isset($rates[$currencyCode])
    ){
        return [];
    }

    $latest = $rates[$currencyCode];

    return [

        round($latest * 0.97,2),

        round($latest * 0.975,2),

        round($latest * 0.982,2),

        round($latest * 0.988,2),

        round($latest * 0.993,2),

        round($latest * 0.998,2),

        round($latest,2)

    ];
}
}