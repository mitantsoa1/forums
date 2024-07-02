<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Topic;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $topics = Topic::all();
        $users = User::all();

        Comment::factory(20)
            ->sequence(fn () => [
                'topic_id' => $topics->random(),
            ])
            ->sequence(fn () => [
                'user_id' => $users->random(),
            ])
            ->create();
    }
}