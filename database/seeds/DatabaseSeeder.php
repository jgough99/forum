<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UserTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(TopicTableSeeder::class);
        $this->call(ThreadTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(TopicUserTableSeeder::class);
        
    }
}
