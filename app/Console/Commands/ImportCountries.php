<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Country;
use Illuminate\Support\Facades\Http;

class ImportCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'countries:import';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
{
    $this->info('Mengambil semua negara...');

    $offset = 0;
    $limit = 100;

    do {

        $response = Http::withToken(env('REST_COUNTRIES_API_KEY'))
    ->connectTimeout(30)
    ->timeout(120)
    ->acceptJson()
    ->get("https://api.restcountries.com/countries/v5?limit={$limit}&offset={$offset}&response_fields=names.common,codes.alpha_2,codes.alpha_3,capitals.name,region,subregion,currencies.code,currencies.name,coordinates.lat,coordinates.lng,flag.url_png");
        if (!$response->successful()) {

            dd(
                $response->status(),
                $response->body()
            );

        }

        $countries = $response->json()['data']['objects'] ?? [];
        foreach ($countries as $country) {

            Country::updateOrCreate(

                [
                    'name' => $country['names']['common']
                ],

                [
                    'iso2' => $country['codes']['alpha_2'] ?? null,
                    'iso3' => $country['codes']['alpha_3'] ?? null,

                    'capital' => $country['capitals'][0]['name'] ?? null,

                    'region' => $country['region'] ?? null,
                    'subregion' => $country['subregion'] ?? null,

                    'currency_code' => $country['currencies'][0]['code'] ?? null,
                    'currency_name' => $country['currencies'][0]['name'] ?? null,

                    'latitude' => $country['coordinates']['lat'] ?? null,
                    'longitude' => $country['coordinates']['lng'] ?? null,

                    'flag_url' => $country['flag']['url_png'] ?? null,
                ]
            );

        }

        $offset += $limit;

    } while(count($countries) > 0);

    $this->info('Semua negara berhasil diimport.');
}
}