<?php

use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
   
    {
       
        //php artisan db:seed --class=CreateUsersTable

        factory(\App\User::class, 10)->create()->each(function($user){
            $user->store()->save(factory(\App\Store::class)->make());
        });
    }
}
