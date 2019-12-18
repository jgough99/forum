<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Topic;
use Faker\Generator as Faker;

$factory->define(Topic::class, function (Faker $faker) {

    //Since only an admin can create a topic, a user with 
    //account_type: admin is chosen at random 
    $admin = (DB::table('users')->where("account_type", "admin"))
    ->inRandomOrder();

    return [
        'creator_id'=>$admin->value("id"),
        'title' => $faker->word(),
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});
