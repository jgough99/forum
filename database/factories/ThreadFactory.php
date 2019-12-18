<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Thread;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    
    // The type of thread is gererated first to allow for some 
    // logic deciding if the solved_status is relevant or not.

    $thread_type = $faker->randomElement(['question','discussion']);
   
    $solved_status = null;
    if ($thread_type == 'question')
    {
        $solved_status = (int) $faker->boolean;;
    }
    
    return [
        'creator_id'=>App\User::inRandomOrder()->first()->id,
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'topic_id'=>App\Topic::inRandomOrder()->first()->id,
        'thread_type' => $thread_type,
        'solved_status' => $solved_status,
    ];
});