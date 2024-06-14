<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectMember>
 */
class ProjectMemberFactory extends Factory
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
            'user_id' => !empty($users) ? fake()->randomElement($users) : User::factory()->create()->id,
            'project_id' => !empty($projects) ? fake()->randomElement($projects) : Project::factory()->create()->id,
            'is_manager' => fake()->boolean(),
        ];
    }
}
