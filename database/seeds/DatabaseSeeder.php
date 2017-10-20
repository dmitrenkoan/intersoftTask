<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin'.'@gmail.com',
            'password' => bcrypt('admin'),
            'remember_token' => str_random(10),
        ]);*/
        factory(App\User::class, 30)->create()->each(function ($u) {
            $u->posts()->save(factory(App\Post::class)->make());
        });


    }
}
