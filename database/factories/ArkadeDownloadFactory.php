<?php

namespace Database\Factories;

use App\Models\ArkadeRelease;
use App\Models\ArkadeDownloader;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArkadeDownload>
 */
class ArkadeDownloadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $arkadeRelease = ArkadeRelease::inRandomOrder()->first();
        $latestDownloadTime = ArkadeRelease::where('released_at', '>', $arkadeRelease->released_at)->first()->released_at ?? $arkadeRelease->released_at->addMonths(3);

        $arkade_downloader = ArkadeDownloader::find(fake()->numberBetween(1, ArkadeDownloader::count()));

        return [
            'downloaded_at' => fake()->dateTimeBetween($arkadeRelease->released_at, $latestDownloadTime),
            'arkade_release_id' => $arkadeRelease->id,
            'arkade_downloader_id' => $arkade_downloader->id,
            'organization_id' => ((int)$arkade_downloader->id % 20) + 1,
            'is_automated' => fake()->boolean(15),
        ];
    }
}
