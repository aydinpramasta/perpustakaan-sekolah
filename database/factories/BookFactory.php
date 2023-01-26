<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(),
            'synopsis' => fake()->paragraphs(2, true),
            'publisher' => fake()->company(),
            'writer' => fake()->name(),
            'publish_year' => fake()->year(),
            'cover' => 'https://source.unsplash.com/random/720x1280',
            'category' => 'Random',
            'amount' => 5,
            'status' => 'Tersedia',
        ];
    }
}
