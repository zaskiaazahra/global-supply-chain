<?php

namespace App\Services;

use App\Models\Article;
use App\Models\NewsCache;
use Illuminate\Support\Facades\Http;

class NewsService
{
    public function getNews($country = "Indonesia", $category = "all")
    {
        $apiKey = env('GNEWS_API_KEY');

      $countryName = strtolower($country) == 'indonesia'
    ? 'Indonesia'
    : $country;

switch($category){

    case 'logistics':

        $keyword = strtolower($country) == 'indonesia'
            ? 'logistik'
            : 'logistics';

        break;

    case 'trade':

        $keyword = strtolower($country) == 'indonesia'
            ? 'perdagangan'
            : 'trade';

        break;

    case 'shipping':

        $keyword = strtolower($country) == 'indonesia'
            ? 'pengiriman'
            : 'shipping';

        break;

    case 'economy':

        $keyword = strtolower($country) == 'indonesia'
            ? 'ekonomi'
            : 'economy';

        break;

    default:

        if(strtolower($country) == 'indonesia'){

            $keyword = 'ekonomi OR logistik OR perdagangan OR pengiriman';

        }else{

            $keyword = 'economy OR logistics OR trade OR shipping';

        }

}

$query = $countryName . ' ' . $keyword;
$cache = NewsCache::where('country', $country)
    ->where('category', $category)
    ->where('cached_at', '>=', now()->subHour())
    ->first();

if ($cache) {

    return json_decode($cache->response, true);

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

$articles = $response->json()['articles'] ?? [];

NewsCache::updateOrCreate(

    [
        'country' => $country,
        'category' => $category
    ],

    [
        'response' => json_encode($articles),
        'cached_at' => now()
    ]

);
foreach($articles as $article){

    Article::firstOrCreate(

        [
            'url' => $article['url']
        ],

        [
            'title' => $article['title'] ?? '',

            'description' => $article['description'] ?? '',

            'source' => $article['source']['name'] ?? '',

            'author' => $article['source']['name'] ?? '',

            'country' => $country,

            'image' => $article['image'] ?? '',

            'published_at' => isset($article['publishedAt'])
    ? date('Y-m-d H:i:s', strtotime($article['publishedAt']))
    : null,
        ]

    );

}

return $articles;
    }
}