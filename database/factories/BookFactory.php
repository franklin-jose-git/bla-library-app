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
    public function definition(): array
    {
        $genres = ['Science', 'Documentary', 'Economics', 'Politics', 'Technology'];

        return [
            'title' => fake()->sentence(6,false),
            'author' => fake()->name(),
            'genre' => fake()->randomElement($genres),
            'isbn' => fake()->isbn13(),
            'total_copies' => fake()->randomNumber(2,false)+1,
        ];
    }
}
