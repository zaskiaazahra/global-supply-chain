<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class EconomyService
{
    public function getIndicator($countryCode, $indicator)
    {
        $url = "https://api.worldbank.org/v2/country/{$countryCode}/indicator/{$indicator}?format=json";

        $response = Http::get($url);

        if (!$response->successful()) {
            return null;
        }

        $data = $response->json();

        if (!isset($data[1])) {
            return null;
        }

        foreach ($data[1] as $item) {

            if ($item['value'] !== null) {

                return [

                    'value' => $item['value'],

                    'date' => $item['date']

                ];

            }

        }

        return null;
    }
}