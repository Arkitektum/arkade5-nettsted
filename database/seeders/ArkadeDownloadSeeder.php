<?php

namespace Database\Seeders;

use App\Models\ArkadeDownload;
use Illuminate\Database\Seeder;

class ArkadeDownloadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ArkadeDownload::factory(600)->create();
    }
}
