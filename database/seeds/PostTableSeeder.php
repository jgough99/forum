<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //A factory will only put the generated data into the database after it has created
        //all of it, therefore when a post looks for a parents post_id it is looking at an 
        //empty database. Using a loop and adding the rows one at a time means there are posts
        //in the table for the newly generated posts to point to as their parent.
        for ($i=0;$i<30;$i++)
        {
            factory(App\Post::class, 1)->create();
        }

        //After the post table is seeded, a random post can be picked for each solved thread
        //to be the solution for the thread.

        //Cycle through each thread to see if it is solved
        for ($i=0;$i<=App\Thread::count();$i++)
        {
            $thread_solved = (DB::table('threads')->where("id", $i)->value('solved_status'));

            //If the thread is solved, update a random post in this thread to make 'solution' = 1 
            if ($thread_solved == 1)
            {
                $random_thread_post = (DB::table('posts')->where("thread_id", $i))
                ->inRandomOrder()->limit(1)->value('id');
                if ($random_thread_post != null)
                {
                    DB::table('posts')->where('id',$random_thread_post)->update(['solution'=>1]);
                }
            }
        }
    }
}
