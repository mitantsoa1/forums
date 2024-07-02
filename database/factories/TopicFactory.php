<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $topics = collect(['Informatique', 'Sciences', 'Univers', 'Programmation', 'Jeux Videos', 'Autres']);
        $title = $this->faker->unique()->randomElement($topics);
        return [
            'title' => $title,
            'slug' => Str::slug($title)
        ];
    }
}