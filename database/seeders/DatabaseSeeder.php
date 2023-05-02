<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(UsersTableSeeder::class);

        // User::factory(10)->create();
        // Post::factory(10)->create();
        // Comment::factory(10)->create();

        // Create 5 users, each has 5 posts and 5 comments, plus 25 tags
        User::factory(5)->create()->each(function($user) {
            for ($i=0; $i < 5; $i++) { 
                $post = Post::factory()->create();
                Comment::factory()->create();

                // Create 25 random tags and attach them to the post
                $tags = Tag::factory()->create();
                $post->tags()->attach($tags->pluck('id')->random());
            }});
    }
}
