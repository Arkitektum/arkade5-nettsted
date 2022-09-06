<?php

namespace App\Console\Commands;

use App\Organization;
use App\Services\OrganizationInfoService;
use Illuminate\Console\Command;
use Throwable;

class UpdateOrganizationInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:update-organization-info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update information for all organizations';

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
        foreach (Organization::get() as $organization) {
            try {
                OrganizationInfoService::setOrganizationInfo($organization);
            } catch (Throwable $throwable) {
                echo 'Could not set organization info for org.number ' . $organization->org_number . ' -> ' . $throwable->getMessage() . PHP_EOL;
            }
        }
    }

}
