<?php

use Illuminate\Database\Seeder;

class DownloaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ArkadeDownloader::class, 200)->create();
    }
}
