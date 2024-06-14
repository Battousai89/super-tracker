<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TimeTrack>
 */
class TimeTrackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::pluck('id')->toArray();
        $tasks = Task::pluck('id')->toArray();
        return [
            'user_id' => !empty($users) ? fake()->randomElement($users) : User::factory()->create()->id,
            'task_id' => !empty($tasks) ? fake()->randomElement($tasks) : Task::factory()->create()->id,
            'explanation' => fake()->text(255),
            'date' => fake()->date(),
            'spent_time' => fake()->numberBetween(0, 9999999),
        ];
    }
}
