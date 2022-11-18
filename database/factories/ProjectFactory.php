<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => fake()->jobTitle(),
            "description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda corporis magnam molestiae non officiis sint sit, ut? Ab aliquam aperiam est, et fugit harum libero, minima neque, officiis quidem velit!",
            "status" => "in_progress",
            "user_id" => User::find(rand(2, User::all()->count())),
        ];
    }
}
