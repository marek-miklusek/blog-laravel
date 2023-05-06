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
        // User::factory(10)->create();
        // Post::factory(10)->create();
        // Comment::factory(10)->create();

        $this->call(RolesTableSeeder::class);

        // Create 5 users, 25 posts, 25 comments and 5 tags
        User::factory(5)->create()->each(function() {
            $tags = Tag::factory()->create();

            for ($i=0; $i < 5; $i++) { 
                $post = Post::factory()->create();
                Comment::factory()->create();

                // Attached random tags to the post
                $post->tags()->attach($tags->pluck('id')->random());
            }});
    }
}
