<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Comment;
use App\Models\Reaction_jmp;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Reaction_jmpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = Comment::all();
        $users = User::all();

        // Get all comment IDs and shuffle them to ensure random order
        $commentIds = $comments->pluck('id')->toArray();
        shuffle($commentIds);

        $userIds = $users->pluck('id')->toArray();
        shuffle($userIds);

        Reaction_jmp::factory(300)
            ->sequence(function () use (&$commentIds) {
                // Pop a comment ID from the array to ensure no duplication
                return ['comment_id' => array_shift($commentIds)];
            })
            ->sequence(function () use (&$userIds) {
                // Pop a comment ID from the array to ensure no duplication
                return ['user_id' => array_shift($userIds)];
            })
            ->create();
    }
}
