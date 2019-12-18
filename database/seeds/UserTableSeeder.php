<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create 10 users 
        factory(App\User::class, 10)->create()->each(function ($user) {
            //Make one user profile for every user with the same User ID.
            //Make and save the user profile seperately in order to not cause
            //an error due to the foreign key relationship.
            $user_profile = factory(App\UserProfile::class)->make();
            $user->userProfile()->save($user_profile);
        });
    }
}
