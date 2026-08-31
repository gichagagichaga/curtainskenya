<?php

namespace Database\Factories;

use App\Models\Story;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Story>
 */
class StoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'eyebrow' => 'The Curtains Kenya way',
            'title' => 'The details change everything.',
            'intro' => 'A room begins to feel like yours in its softest layers.',
            'body' => 'We bring together practical pieces and lasting finishes so you can create a home that works hard and welcomes softly.',
        ];
    }
}
