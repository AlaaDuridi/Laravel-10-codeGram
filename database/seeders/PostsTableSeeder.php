<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Let's assume we have a user with ID 1

        $user = User::find(4);

        //Insert some posts for the user

        Post::create([
            'user_id' => $user->id,
            'title' => 'First post',
            'content' => 'This is my first blog post!',
            'is_published' => true,
        ]);

        Post::create([
            'user_id' => $user->id,
            'title' => 'Second post',
            'content' => 'This is my first blog post!',
            'is_published' => true,
        ]);


        //Let's assume user ID = 10 - Samaher


    }
}
