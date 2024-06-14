<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
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
        $projects = Project::pluck('id')->toArray();
        $users = User::pluck('id')->toArray();
        return [
            'name' => fake()->text(100),
            'description' => fake()->text(),
            'time_estimate' => fake()->numberBetween(0, 9999999),
            'project_id' => !empty($projects) ? fake()->randomElement($projects) : Project::factory()->create()->id,
            'user_id' => fake()->randomElement([null, User::factory()->create()->id, ...$users])
        ];
    }
}
