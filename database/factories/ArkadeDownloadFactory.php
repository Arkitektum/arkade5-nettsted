<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ArkadeDownload;
use App\ArkadeRelease;
use App\User;
use Faker\Generator as Faker;

$factory->define(ArkadeDownload::class, function (Faker $faker) {

    $arkadeRelease = ArkadeRelease::find($faker->numberBetween(1, ArkadeRelease::count()));
    $latestDownloadTime = ArkadeRelease::find($arkadeRelease->id + 2)->released_at ?? $arkadeRelease->released_at->addMonths(3);

    $user = User::find($faker->numberBetween(1, User::count()));

    return [
        'downloaded_at' => $faker->dateTimeBetween($arkadeRelease->released_at, $latestDownloadTime),
        'arkade_release_id' => $arkadeRelease->id,
        'arkade_downloader_id' => $user->id,
        'organization_id' => ((int)$user->id % 20) + 1,
        'is_automated' => $faker->boolean(15),
    ];
});
