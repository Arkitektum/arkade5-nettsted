<?php

namespace App\Console\Commands;

use App\Organization;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SetOrganizationAddressCoordinates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:set-organization-address-coordinates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all organizations with address coordinates';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $organizationsWithoutCoordinates = Organization::whereNull('latitude')->orWhereNull('longitude')->get();

        foreach ($organizationsWithoutCoordinates->whereNotNull('address') as $organization) {

            $coordinates = $this->getCoordinates($organization->address);

            $organization->latitude = $coordinates['lat'];
            $organization->longitude = $coordinates['lon'];

            $organization->save();
        }
    }

    /**
     * @return string[]
     */
    private function getCoordinates($address): array
    {
        $response = Http::get('https://ws.geonorge.no/adresser/v1/sok?sok=' . $address);

        $lat = null;
        $lon = null;

        if ($response->successful()) {
            try {
                $representationPoint = $response['adresser'][0]['representasjonspunkt'];
                $lat = $representationPoint['lat'];
                $lon = $representationPoint['lon'];
            } catch (\Exception $exception) {
                echo 'Could not get coordinates for ' . $address . ': ' . $exception->getMessage() . PHP_EOL;
            }
        }

        return ['lat' => $lat, 'lon' => $lon];
    }
}
