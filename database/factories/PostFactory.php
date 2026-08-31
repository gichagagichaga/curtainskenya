<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(6);

        return [
            'author_id' => User::factory(),
            'blog_category_id' => BlogCategory::factory(),
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(1, 99999),
            'excerpt' => fake()->paragraph(),
            'content' => '## '.fake()->sentence(4)."\n\n".fake()->paragraphs(3, true),
            'status' => 'draft',
            'reading_time' => 3,
        ];
    }

    public function published(): static
    {
        return $this->state(fn (): array => [
            'status' => 'published',
            'published_at' => now()->subDay(),
        ]);
    }
}
