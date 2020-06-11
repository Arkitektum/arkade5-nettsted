<?php

use App\ArkadeRelease;
use Illuminate\Database\Seeder;

class ArkadeReleaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ArkadeRelease::create([
            'version_number' => '2.0.0',
            'user_interface' => 'GUI',
            'package_filename' => 'Arkade5_GUI_2.0.0.msi',
            'released_at' => '2020-07-08'
        ]);

        ArkadeRelease::create([
            'version_number' => '2.0.0',
            'user_interface' => 'CLI',
            'package_filename' => 'Arkade5_CLI_2.0.0.zip',
            'released_at' => '2020-07-08'
        ]);

        ArkadeRelease::create([
            'version_number' => '2.1.0',
            'user_interface' => 'GUI',
            'package_filename' => 'Arkade5_GUI_2.1.0.msi',
            'released_at' => '2020-10-19'
        ]);

        ArkadeRelease::create([
            'version_number' => '2.1.0',
            'user_interface' => 'CLI',
            'package_filename' => 'Arkade5_CLI_2.1.0.zip',
            'released_at' => '2020-10-19'
        ]);

        ArkadeRelease::create([
            'version_number' => '2.2.0',
            'user_interface' => 'GUI',
            'package_filename' => 'Arkade5_GUI_2.2.0.msi',
            'released_at' => '2021-01-15'
        ]);

        ArkadeRelease::create([
            'version_number' => '2.2.0',
            'user_interface' => 'CLI',
            'package_filename' => 'Arkade5_CLI_2.2.0.zip',
            'released_at' => '2021-01-15'
        ]);
    }
}
