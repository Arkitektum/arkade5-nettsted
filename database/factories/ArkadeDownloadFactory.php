<?php

namespace Database\Factories;

use App\Models\ArkadeRelease;
use App\Models\User;
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
        $arkadeRelease = ArkadeRelease::find(fake()->numberBetween(1, ArkadeRelease::count()));
        $latestDownloadTime = ArkadeRelease::find($arkadeRelease->id + 2)->released_at ?? $arkadeRelease->released_at->addMonths(3);

        $user = User::find(fake()->numberBetween(1, User::count()));

        return [
            'downloaded_at' => fake()->dateTimeBetween($arkadeRelease->released_at, $latestDownloadTime),
            'arkade_release_id' => $arkadeRelease->id,
            'arkade_downloader_id' => $user->id,
            'organization_id' => ((int)$user->id % 20) + 1,
            'is_automated' => fake()->boolean(15),
        ];
    }
}
