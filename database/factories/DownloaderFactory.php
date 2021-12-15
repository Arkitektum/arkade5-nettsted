<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ArkadeDownloader;
use Faker\Generator as Faker;

$factory->define(ArkadeDownloader::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'wants_news' => $faker->boolean(),
    ];
});
