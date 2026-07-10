<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class EconomyService
{
    public function getIndicator($country, $indicator)
{
    try {

        $response = Http::timeout(60)
            ->connectTimeout(15)
            ->retry(2, 1000)
            ->get(
                "https://api.worldbank.org/v2/country/{$country}/indicator/{$indicator}?format=json"
            );

        if (!$response->successful()) {
            return null;
        }

        $data = $response->json();

        if (!isset($data[1])) {
            return null;
        }

        foreach ($data[1] as $item) {

            if (!empty($item['value'])) {
                return $item;
            }

        }

        return null;

    } catch (\Exception $e) {

        return null;

    }
}
public function getCountryInfo($country)
{
    $response = Http::get(
        "https://api.worldbank.org/v2/country/{$country}?format=json"
    );

    if (!$response->successful()) {
        return null;
    }

    $data = $response->json();

    if (!isset($data[1][0])) {
        return null;
    }

    return $data[1][0];
}
public function getIndicatorHistory($country, $indicator)
{
    $response = Http::get(
        "https://api.worldbank.org/v2/country/{$country}/indicator/{$indicator}?format=json&per_page=10"
    );

    if (!$response->successful()) {
        return [];
    }

    $data = $response->json();

    if (!isset($data[1])) {
        return [];
    }

    $history = [];

    foreach ($data[1] as $item) {

        if (!empty($item['value'])) {

            $history[] = [

                'year' => $item['date'],

                'value' => round($item['value']/1000000000000,2)

            ];

        }

    }

    return array_reverse($history);
}
}