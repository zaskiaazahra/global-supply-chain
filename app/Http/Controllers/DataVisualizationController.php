<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\DataVisualizationService;

class DataVisualizationController extends Controller
{
    public function index(DataVisualizationService $service)
{
    $countries = Country::orderBy('name')->get();

    $selected = request('country','Indonesia');

    $country = Country::where('name',$selected)->first();

    $currencyTrend = $service->getCurrencyTrend(
    $country->currency_code
);

    $gdpTrend = $service->getGDPTrend($country->iso2);

    $inflationTrend = $service->getInflationTrend($country->iso2);

    $latestRisk = rand(35,75);

$riskTrend = [

    max(0,$latestRisk-12),

    max(0,$latestRisk-9),

    max(0,$latestRisk-6),

    max(0,$latestRisk-4),

    max(0,$latestRisk-2),

    max(0,$latestRisk-1),

    $latestRisk

];
    return view(
        'visualization.index',
        compact(

            'countries',

            'selected',

            'gdpTrend',

            'inflationTrend',

            'currencyTrend',

            'riskTrend'

        )
    );
}
}