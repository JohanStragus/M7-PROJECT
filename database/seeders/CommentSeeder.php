<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $users = \App\Models\User::all();
        $posts = \App\Models\Post::all();

        foreach ($posts as $post) {
            for ($i = 0; $i < 5; $i++) {
                \App\Models\Comment::create([
                    'content' => $faker->paragraph(1),
                    'user_id' => $users->random()->id,
                    'post_id' => $post->id,
                ]);
            }
        }
    }
}
