<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//

		if (User::count() == 0) {

			$user = new User();
			$user->name = 'Levente Proksa';
			$user->password = '$2y$10$QIJHp09DghAZxa6B/ht76.xnDXXZMwuzBmM4L6wpCCvGOKWPLbWTi';
			$user->email = 'proksalevente@gmail.com';

			$user->save();
		}

		User::factory(10)->create();
	}
}
