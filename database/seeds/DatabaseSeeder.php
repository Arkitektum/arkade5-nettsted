<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(DownloaderSeeder::class);
        $this->call(OrganizationSeeder::class);
        $this->call(ArkadeReleaseSeeder::class);
        $this->call(ArkadeDownloadSeeder::class);
    }
}
