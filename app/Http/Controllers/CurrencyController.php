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

    $countries = Country::where('currency_code', $code)->get();

    foreach ($countries as $country) {

        $country->rate = $rate;

        $currencies->push($country);

    }

}

        $currencies = $currencies
            ->sortBy('name')
            ->values();

        return view('currency.index', [
            'currencies' => $currencies,
            'rates' => $rates,
        ]);
    }
}