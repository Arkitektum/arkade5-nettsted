<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ArkadeDownloader;
use Faker\Generator as Faker;

$factory->define(ArkadeDownloader::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'has_arkade_v1_experience' => $faker->boolean(),
        'wants_news' => $faker->boolean(),
    ];
});
