<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Reaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = Comment::all();

        // Get all comment IDs and shuffle them to ensure random order
        $commentIds = $comments->pluck('id')->toArray();
        shuffle($commentIds);


        Reaction::factory(300)
            ->sequence(function () use (&$commentIds) {
                // Pop a comment ID from the array to ensure no duplication
                return ['comment_id' => array_shift($commentIds)];
            })
            ->create();
    }
}
