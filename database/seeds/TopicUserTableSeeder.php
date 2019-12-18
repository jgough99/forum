<?php

use Illuminate\Database\Seeder;

class TopicUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Get all topics
        $topics = App\Topic::all();

        //For each user in the database, attach three random topics 
        //in order to populate the pivot table with liked topics  
        App\User::all()->each(function ($user) use ($topics) { 
            $user->likedTopics()->attach(
                $topics->random(rand(1, 3))->pluck('id')->toArray()
            ); 
        });
    }
}
