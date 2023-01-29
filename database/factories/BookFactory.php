<?php

namespace Database\Factories;

use App\Models\Book;
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
            'cover' => null,
            'category' => 'Random',
            'amount' => 5,
            'status' => Book::STATUSES['Available'],
        ];
    }
}
