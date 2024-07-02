<?php

namespace Database\Seeders;

use App\Models\Topic;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $topics = Topic::all();
        $users = User::all();

        Post::factory(20)
            ->sequence(fn () => [
                'topic_id' => $topics->random(),
            ])
            ->sequence(fn () => [
                'user_id' => $users->random(),
            ])
            ->hasComments(0, fn () => ['user_id' => $users->random()])
            ->create();
    }
}
