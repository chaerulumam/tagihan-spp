<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'nisn' => fake()->randomNumber(7, true),
            'jurusan' => fake()->word('RPL'),
            'kelas' => fake()->randomLetter('X'),
            'angkatan' => fake()->year(),
            'user_id' => fake()->randomDigitNotNull(1),
        ];
    }
}
