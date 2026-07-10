<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NewsService
{
    public function getNews($country = "Indonesia")
    {
        $apiKey = env('GNEWS_API_KEY');

        if(strtolower($country) == 'indonesia'){

    $query = "Indonesia ekonomi OR logistik OR geopolitik";

}else{

    $query = $country . " economy OR logistics OR geopolitics";

}
        $lang = strtolower($country) == 'indonesia' ? 'id' : 'en';

        $response = Http::get(
    "https://gnews.io/api/v4/search",
    [
        "q" => $query,
        "lang" => $lang,
        "max" => 10,
        "apikey" => $apiKey
    ]
);

        if(!$response->successful()){
            return [];
        }

        return $response->json()['articles'] ?? [];
    }
}