<?php

namespace Database\Seeders;

use App\Models\ArkadeRelease;
use Illuminate\Database\Seeder;

class ArkadeReleaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ArkadeRelease::create([
            'version_number' => '2.0.0',
            'user_interface' => 'GUI',
            'package_filename' => 'Arkade5-2.0.0.msi',
            'released_at' => '2020-07-08'
        ]);

        ArkadeRelease::create([
            'version_number' => '2.0.0',
            'user_interface' => 'CLI',
            'package_filename' => 'Arkade5CLI-2.0.0.zip',
            'released_at' => '2020-07-08'
        ]);

        ArkadeRelease::create([
            'version_number' => '2.1.0',
            'user_interface' => 'GUI',
            'package_filename' => 'Arkade5-2.1.0.msi',
            'released_at' => '2020-10-19'
        ]);

        ArkadeRelease::create([
            'version_number' => '2.1.0',
            'user_interface' => 'CLI',
            'package_filename' => 'Arkade5CLI-2.1.0.zip',
            'released_at' => '2020-10-19'
        ]);

        ArkadeRelease::create([
            'version_number' => '2.2.0',
            'user_interface' => 'GUI',
            'package_filename' => 'Arkade5-2.2.0.msi',
            'released_at' => '2021-01-15'
        ]);

        ArkadeRelease::create([
            'version_number' => '2.2.0',
            'user_interface' => 'CLI',
            'package_filename' => 'Arkade5CLI-2.2.0.zip',
            'released_at' => '2021-01-15'
        ]);
    }
}
