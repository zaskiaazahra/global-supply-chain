<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CountryService
{
    public function fetchCountries()
    {
        $response = Http::withToken(env('REST_COUNTRIES_API_KEY'))
            ->acceptJson()
            ->get('https://api.restcountries.com/countries/v5');

        return [
            'status' => $response->status(),
            'body' => $response->json(),
        ];
    }
}