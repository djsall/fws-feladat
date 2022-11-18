<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run() {
		// \App\Models\User::factory(10)->create();

		// \App\Models\User::factory()->create([
		//     'name' => 'Test User',
		//     'email' => 'test@example.com',
		// ]);
		$this->call([
			UserSeeder::class,
		]);

		Project::factory(20)->has(User::factory()->count(3))->create();
		Ticket::factory(20)->create();

		foreach (Project::all() as $project){
			$project->contacts()->attach(User::find(rand(2, User::count())));
		}
	}
}
