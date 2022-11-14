<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	    $user = new User();
			$user->name = 'Levente Proksa';
			$user->password = '$2y$10$QIJHp09DghAZxa6B/ht76.xnDXXZMwuzBmM4L6wpCCvGOKWPLbWTi';
			$user->email = 'proksalevente@gmail.com';

			$user->save();

			for ($i = 0; $i < 10; $i++){
				$name = Str::random(10);

				$user = new User();
				$user->name = $name;
				$user->email = $name . '@gmail.com';
				$user->password = Hash::make('password');

				$user->save();
			}
    }
}
