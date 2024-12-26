<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = Post::factory(50)->create();

        $posts->each(function (Post $post) {
            $post->categories()->attach(random_int(1, 10));
        });
    }
}
