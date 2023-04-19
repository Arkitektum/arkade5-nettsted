<?php

namespace Database\Seeders;

use App\Models\ArkadeDownloader;
use Illuminate\Database\Seeder;

class DownloaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ArkadeDownloader::factory(200)->create();
    }
}
