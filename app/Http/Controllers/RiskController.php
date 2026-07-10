<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\WeatherService;
use App\Services\CurrencyService;
use App\Services\EconomyService;
use App\Services\NewsService;
use App\Services\SentimentService;

class RiskController extends Controller
{
    public function index(

    WeatherService $weatherService,

    CurrencyService $currencyService,

    EconomyService $economyService,

    NewsService $newsService,

    SentimentService $sentimentService

)
    {
        $countries = Country::orderBy('name')->get();

        $selected = request('country', 'Indonesia');

        $country = Country::where('name', $selected)->first();

        if (!$country) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | WEATHER
        |--------------------------------------------------------------------------
        */

        $weather = $weatherService->getWeatherByCountry($selected);

        /*
        |--------------------------------------------------------------------------
        | ECONOMY
        |--------------------------------------------------------------------------
        */

        $inflation = $economyService->getIndicator(
            $country->iso2,
            'FP.CPI.TOTL.ZG'
        );

        /*
        |--------------------------------------------------------------------------
        | CURRENCY
        |--------------------------------------------------------------------------
        */

        $currency = $currencyService->getCurrencyData($country);

        /*
        |--------------------------------------------------------------------------
        | NEWS
        |--------------------------------------------------------------------------
        */

        $articles = $newsService->getNews($selected);

        $sentiment = $sentimentService->analyze($articles);

        /*
        |--------------------------------------------------------------------------
        | RISK SCORE
        |--------------------------------------------------------------------------
        */

        $weatherRisk = 10;
        $inflationRisk = 10;
        $currencyRisk = 10;
        $newsRisk = 10;

        // Weather
        if(isset($weather['current']['wind_speed_10m'])){

            if($weather['current']['wind_speed_10m'] > 30){

                $weatherRisk = 25;

            }

        }

        // Inflation
        if($inflation){

            if($inflation['value'] > 7){

                $inflationRisk = 25;

            }elseif($inflation['value'] > 3){

                $inflationRisk = 15;

            }

        }

        // Currency
        if($currency && $currency['rate']){

            $currencyRisk = 10;

        }

        // News Sentiment

if($sentiment['sentiment'] == 'Negative'){

    $newsRisk = 25;

}elseif($sentiment['sentiment'] == 'Neutral'){

    $newsRisk = 15;

}else{

    $newsRisk = 5;

}
        $totalRisk =
            $weatherRisk +
            $inflationRisk +
            $currencyRisk +
            $newsRisk;

        if($totalRisk <= 25){

            $riskLevel = "LOW";

        }elseif($totalRisk <= 50){

            $riskLevel = "MEDIUM";

        }elseif($totalRisk <= 75){

            $riskLevel = "HIGH";

        }else{

            $riskLevel = "VERY HIGH";

        }

        return view('risk.index', compact(

        'countries',

        'selected',

        'weather',

        'inflation',

        'currency',

        'articles',

        'sentiment',

        'weatherRisk',

        'inflationRisk',

        'currencyRisk',

        'newsRisk',

        'totalRisk',

        'riskLevel'

        ));
    }
}