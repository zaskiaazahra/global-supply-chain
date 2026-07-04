<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\CurrencyService;

class CurrencyController extends Controller
{
    public function index(CurrencyService $currencyService)
    {
        $rates = $currencyService->getRates();

        $currencies = collect();

        foreach ($rates as $code => $rate) {

            $country = Country::where('currency_code', $code)->first();

            if ($country) {

                $country->rate = $rate;

                $currencies->push($country);

            }

        }

       return view('currency.index', [
    'currencies' => $currencies,
    'rates' => $rates,
]);
}
}