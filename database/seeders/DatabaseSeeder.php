<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(UsersTableSeeder::class);

        // \App\Models\User::factory(10)->create();
        // \App\Models\Post::factory(10)->create();
        // \App\Models\Comment::factory(10)->create();

        // Create 5 users, each has 5 posts and 5 comments
        \App\Models\User::factory(5)->create()->each(function($user) {
            for ($i=0; $i < 5; $i++) { 
                $user->posts()->save(\App\Models\Post::factory()->make());
                $user->comments()->save(\App\Models\Comment::factory()->make());
            }
        });

    }
}
