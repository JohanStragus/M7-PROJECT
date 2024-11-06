<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facker = Faker::create();
        $users = User::all();

        for($i=0;$i<100;$i++){
            \App\Models\Post::create([
                'title' => $facker->sentence(),
                'content' => $facker->text(rand(500, 900)),
                'user_id' => $users->random()->id,
            ]);
        }
    }
}
