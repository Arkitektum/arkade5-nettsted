<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Organization;
use Faker\Generator as Faker;

$factory->define(Organization::class, function (Faker $faker) {

    return [
        'name' => $faker->company,
        'org_form' => $faker->randomElement(['IKS - Interkommunalt selskap', 'KOMM - Kommune']),
        'org_number' => $faker->randomNumber('9'),
        'address' => $faker->address,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
    ];
});
