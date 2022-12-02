<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory {
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition() {
		return [


			//
			"name"        => fake()->company(),
			"description" => Str::limit("Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda corporis magnam molestiae non officiis sint sit, ut? Ab aliquam aperiam est, et fugit harum libero, minima neque, officiis quidem velit!
												Ad, animi assumenda beatae commodi cupiditate delectus enim et eveniet incidunt inventore laborum, mollitia nostrum odio pariatur porro quam quia, repudiandae rerum sapiente sint totam vel velit veritatis vero voluptas.
												Accusamus animi asperiores beatae dicta dignissimos dolorem dolores eius fuga iusto labore molestias nemo qui repudiandae sapiente, vero! Atque, fugiat harum necessitatibus numquam officia quia quidem quisquam repellat voluptatem
													voluptatibus.", rand(25, 500)),
			"project_id"  => Project::find(rand(1, Project::count())),
			"owner_id"    => User::find(rand(1, User::count())),
			"status"      => array_keys(Ticket::$statuses)[rand(0, 2)],
			"created_by"  => User::find(rand(1, User::count())),
		];
	}
}
