<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Port;

class ImportPorts extends Command
{
    protected $signature = 'ports:import';

    protected $description = 'Import World Port Index CSV';

    public function handle()
    {
        $path = storage_path('app/updatedpub150.csv');

        if (!file_exists($path)) {

            $this->error('CSV file not found.');

            return;
        }

        $handle = fopen($path, 'r');

        $header = fgetcsv($handle);

        while (($row = fgetcsv($handle)) !== false) {

            $data = array_combine($header, $row);

            Port::create([

                'country_code' => trim($data['Country Name'] ?? ''),

                'region' => $data['Region Name'] ?? null,

                'port_name' => $data['Main Port Name'] ?? null,

                'harbor_type' => $data['Harbor Type'] ?? null,

                'harbor_size' => $data['Harbor Size'] ?? null,

                'latitude' => $data['Latitude'] ?? null,

                'longitude' => $data['Longitude'] ?? null,

            ]);

        }

        fclose($handle);

        $this->info('World Port Index imported successfully.');
    }
}