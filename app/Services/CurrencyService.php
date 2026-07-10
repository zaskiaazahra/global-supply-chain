<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyService
{
    public function getRates()
    {
        $apiKey = config('services.exchange_rate.key');

        $url = "https://v6.exchangerate-api.com/v6/{$apiKey}/latest/USD";

        $response = Http::timeout(30)
            ->connectTimeout(15)
            ->get($url);

        if (!$response->successful()) {
            return [];
        }

        $data = $response->json();

        return $data['conversion_rates'] ?? [];
    }

    public function getCurrencyData($country)
    {
        if (!$country) {
            return null;
        }

        $rates = $this->getRates();

        $currencyCode = $country->currency_code;

        return [

            'code' => $currencyCode,

            'rate' => $rates[$currencyCode] ?? null

        ];
    }
}