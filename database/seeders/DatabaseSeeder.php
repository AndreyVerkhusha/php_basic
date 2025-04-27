<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
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
        $tags = Tag::factory(5)->create();
        $categories = Category::factory(5)->create();
        $user = User::factory(1)->create();
        $posts = Post::factory(20)->create();

        foreach ($posts as $post) {
            $randomTags = $tags->random(2)->pluck('id');
            $post->tags()->attach($randomTags);
        }
        // \App\Models\User::factory(10)->create();
    }
}
