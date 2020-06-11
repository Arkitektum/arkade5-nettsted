<?php

use Illuminate\Database\Seeder;

class ArkadeDownloadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ArkadeDownload::class, 600)->create();
    }
}
