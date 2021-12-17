<?php

namespace App\Console\Commands;

use App\Organization;
use App\Services\OrganizationInfoService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Throwable;

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

            try {
                $coordinates = OrganizationInfoService::getCoordinates($organization->address);

                $organization->latitude = $coordinates['lat'];
                $organization->longitude = $coordinates['lon'];

                $organization->save();
            } catch (Throwable $throwable) {
                echo 'Could not get coordinates for ' . $organization->address . ' -> ' . $throwable->getMessage() . PHP_EOL;
            }
        }
    }

}
