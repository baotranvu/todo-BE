<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'is_completed' => $this->faker->boolean,
            'priority' => $this->faker->randomElement(['low', 'medium', 'high', 'critical']),
            'progress' => $this->faker->numberBetween(0, 10) * 10,
            'description' => $this->faker->sentence,
            //start_date and due_date in 2025 and start_date must be before due_date
            'start_date' => $this->faker->dateTimeBetween('2025-01-01', '2025-01-31'),
            'due_date' => $this->faker->dateTimeBetween($this->faker->dateTimeBetween('2025-01-01', '2025-01-31'), '2025-02-28'),
        ];
    }
}
