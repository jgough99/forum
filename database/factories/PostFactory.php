<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Post;
use Faker\Generator as Faker;
$factory->define(Post::class, function (Faker $faker) {
    
    //The thread_id is generated above the retun statement
    //to allow for logic deciding if the solution column should
    //be null or a binary value
    $thread_id = App\Thread::inRandomOrder()->first()->id;
    $thread_type = (DB::table('threads')->where("id", (string)$thread_id))
    ->value('thread_type');

    //If the thread is a discussion rather than a question
    //there is no need for a solution column value
    if ($thread_type == "discussion"){
        $solution = null;
    }
    else{
        $solution = 0; 
    }

    //Get existing posts in the same thread in random order
    $posts_in_thread = (DB::table('posts')->where("thread_id", (string)$thread_id))
    ->inRandomOrder()->get();

    //If there are not existing posts in the same thread, it has no parent
    if ($posts_in_thread->count() == 0){
         $parent_id = null;
    }
    //If there are existing posts in the same thread, the parent is chosen
    else{
         $parent_id = $posts_in_thread->first()->id;
    }
    
    return [
        'user_id'=>App\User::inRandomOrder()->first()->id,
        'content' => $faker->sentence($nbWords = 20, $variableNbWords = true),
        'thread_id'=> $thread_id,
        'parent_id'=>$parent_id,
        'upvotes' => $faker->numberBetween(0,1000),
        'downvotes' => $faker->numberBetween(0,1000),
        'solution' => $solution,
        'image' => null,
    ];
});