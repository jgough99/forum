<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserProfile;
use Faker\Generator as Faker;

$factory->define(UserProfile::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'score' => $faker->numberBetween(-1000,1000),
        'avatar' => $faker->image('public/storage/images',640,480, null, false),
    ];
});
