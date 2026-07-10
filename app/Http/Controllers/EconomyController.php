<?php

namespace App\Http\Controllers;

use App\Services\EconomyService;
use App\Models\Country;

class EconomyController extends Controller
{
    protected $economyService;

    public function index(EconomyService $economyService)
{
    $countries = Country::orderBy('name')->get();

    $selected = request('country', 'Indonesia');

    $country = Country::where('name', $selected)->first();

    $code = $country->iso2 ?? 'ID';

    // =========================
    // WORLD BANK DATA
    // =========================

    $gdp = $economyService->getIndicator($code,'NY.GDP.MKTP.CD');

    $population = $economyService->getIndicator($code,'SP.POP.TOTL');

    $inflation = $economyService->getIndicator($code,'FP.CPI.TOTL.ZG');

    $export = $economyService->getIndicator($code,'NE.EXP.GNFS.CD');

    $import = $economyService->getIndicator($code,'NE.IMP.GNFS.CD');

    $gdpHistory = $economyService->getIndicatorHistory($code,'NY.GDP.MKTP.CD');

    $countryInfo = $economyService->getCountryInfo($code);

    // =========================
    // TRADE BALANCE
    // =========================

    $tradeBalance = null;

    if($export && $import){

        $tradeBalance = $export['value'] - $import['value'];

    }

    // =========================
    // INSIGHT
    // =========================

    $insights = [];

    if($gdp){

        if($gdp['value'] >= 1000000000000){

            $insights[] = "Strong national economy based on GDP.";

        }else{

            $insights[] = "Developing economy with moderate GDP.";

        }

    }

    if($inflation){

        if($inflation['value'] <= 3){

            $insights[] = "Inflation remains stable.";

        }else{

            $insights[] = "Inflation is relatively high.";

        }

    }

    if($tradeBalance !== null){

        if($tradeBalance >= 0){

            $insights[] = "Exports exceed imports (Trade Surplus).";

        }else{

            $insights[] = "Imports exceed exports (Trade Deficit).";

        }

    }

    if($population){

        if($population['value'] > 100000000){

            $insights[] = "Large domestic market potential.";

        }else{

            $insights[] = "Population size is relatively small.";

        }

    }

    // =========================
    // STATUS
    // =========================

    $status = [

        'economy' => 'Developing',

        'inflation' => 'High',

        'trade' => 'Deficit',

        'population' => 'Small'

    ];

    if($gdp && $gdp['value'] >= 1000000000000){

        $status['economy'] = 'Strong';

    }

    if($inflation && $inflation['value'] <= 3){

        $status['inflation'] = 'Stable';

    }

    if($tradeBalance !== null && $tradeBalance >= 0){

        $status['trade'] = 'Surplus';

    }

    if($population && $population['value'] > 100000000){

        $status['population'] = 'Large Market';

    }

    return view('economy.index', compact(

        'countries',

        'selected',

        'gdp',

        'population',

        'inflation',

        'export',

        'import',

        'countryInfo',

        'gdpHistory',

        'tradeBalance',

        'insights',

        'status'

    ));
}
}