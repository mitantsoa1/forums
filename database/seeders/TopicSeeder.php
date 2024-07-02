<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $topics = collect(['Informatique', 'Sciences', 'Univers', 'Programmation', 'Jeux Videos', 'Autres']);
        // $topics->each(fn ($topic) => Topic::created([
        //     'name' => $topic,
        //     'slug' => Str::slug($topic)
        // ]));

        Topic::factory()->count(6)->create();
    }
}