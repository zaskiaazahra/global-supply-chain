<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Services\WeatherService;
use App\Services\CurrencyService;
use App\Services\EconomyService;
use App\Services\NewsService;
use App\Services\SentimentService;

class ComparisonController extends Controller
{

    private function weatherText($code)
    {
        return match($code){

            0 => '☀️ Clear Sky',

            1,2 => '🌤 Partly Cloudy',

            3 => '☁️ Cloudy',

            45,48 => '🌫 Fog',

            51,53,55 => '🌦 Drizzle',

            61,63,65 => '🌧 Rain',

            71,73,75 => '❄️ Snow',

            80,81,82 => '🌧 Heavy Rain',

            95 => '⛈ Thunderstorm',

            default => '🌍 Unknown'

        };
    }

    public function index(

        WeatherService $weatherService,
        CurrencyService $currencyService,
        EconomyService $economyService,
        NewsService $newsService,
        SentimentService $sentimentService

    )
    {

        $countries = Country::orderBy('name')->get();

        $countryA = request('countryA','Indonesia');
        $countryB = request('countryB','Singapore');

        $dataA = Country::where('name',$countryA)->first();
        $dataB = Country::where('name',$countryB)->first();

        $gdpA = null;
        $gdpB = null;

        $inflationA = null;
        $inflationB = null;

        $weatherA = null;
        $weatherB = null;

        $weatherTextA = '-';
        $weatherTextB = '-';

        $riskA = 0;
        $riskB = 0;

                // ==========================
        // COUNTRY A
        // ==========================

        if($dataA){

            $gdpA = $economyService->getIndicator(
                $dataA->iso2,
                'NY.GDP.MKTP.CD'
            );

            $inflationA = $economyService->getIndicator(
                $dataA->iso2,
                'FP.CPI.TOTL.ZG'
            );

            $weatherA = $weatherService->getCurrentWeather(
                $dataA->latitude,
                $dataA->longitude
            );

            if($weatherA){

                $weatherTextA = $this->weatherText(
                    $weatherA['current']['weather_code']
                );

            }

            $articlesA = $newsService->getNews($countryA);

            $sentimentA = $sentimentService->analyze($articlesA);

            $weatherRisk = 10;
            $inflationRisk = 10;
            $currencyRisk = 10;
            $newsRisk = 10;

            // Weather Risk

            if(isset($weatherA['current']['wind_speed_10m'])){

                if($weatherA['current']['wind_speed_10m'] > 30){

                    $weatherRisk = 25;

                }

            }
        

            // Inflation Risk

            if($inflationA){

                if($inflationA['value'] > 7){

                    $inflationRisk = 25;

                }

                elseif($inflationA['value'] > 3){

                    $inflationRisk = 15;

                }

            }

            // Currency Risk

            $currency = $currencyService->getCurrencyData($dataA);

            if($currency && $currency['rate']){

                $currencyRisk = 10;

            }

            // News Risk

            if($sentimentA['sentiment']=="Negative"){

                $newsRisk = 25;

            }

            elseif($sentimentA['sentiment']=="Neutral"){

                $newsRisk = 15;

            }

            else{

                $newsRisk = 5;

            }

            $riskA =
                $weatherRisk +
                $inflationRisk +
                $currencyRisk +
                $newsRisk;

        }
                // ==========================
        // COUNTRY B
        // ==========================

        if($dataB){

            $gdpB = $economyService->getIndicator(
                $dataB->iso2,
                'NY.GDP.MKTP.CD'
            );

            $inflationB = $economyService->getIndicator(
                $dataB->iso2,
                'FP.CPI.TOTL.ZG'
            );

            $weatherB = $weatherService->getCurrentWeather(
                $dataB->latitude,
                $dataB->longitude
            );

            if($weatherB){

                $weatherTextB = $this->weatherText(
                    $weatherB['current']['weather_code']
                );

            }

            $articlesB = $newsService->getNews($countryB);

            $sentimentB = $sentimentService->analyze($articlesB);

            $weatherRisk = 10;
            $inflationRisk = 10;
            $currencyRisk = 10;
            $newsRisk = 10;

            // Weather Risk

            if(isset($weatherB['current']['wind_speed_10m'])){

                if($weatherB['current']['wind_speed_10m'] > 30){

                    $weatherRisk = 25;

                }

            }

            // Inflation Risk

            if($inflationB){

                if($inflationB['value'] > 7){

                    $inflationRisk = 25;

                }

                elseif($inflationB['value'] > 3){

                    $inflationRisk = 15;

                }

            }

            // Currency Risk

            $currency = $currencyService->getCurrencyData($dataB);

            if($currency && $currency['rate']){

                $currencyRisk = 10;

            }

            // News Risk

            if($sentimentB['sentiment']=="Negative"){

                $newsRisk = 25;

            }

            elseif($sentimentB['sentiment']=="Neutral"){

                $newsRisk = 15;

            }

            else{

                $newsRisk = 5;

            }

            $riskB =
                $weatherRisk +
                $inflationRisk +
                $currencyRisk +
                $newsRisk;

        }

        return view('comparison.index', compact(

            'countries',

            'countryA',
            'countryB',

            'dataA',
            'dataB',

            'gdpA',
            'gdpB',

            'inflationA',
            'inflationB',

            'weatherA',
            'weatherB',

            'weatherTextA',
            'weatherTextB',

            'riskA',
            'riskB'

        ));

    }

}