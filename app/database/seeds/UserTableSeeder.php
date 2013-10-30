<?php

class UserTableSeeder extends Seeder {

	public function run()
	{

		DB::table('users')->truncate();

	    User::create(array('email' => 'Basic@Fake.com', 'password' => Hash::make('secret'), 'level' => 1));
	    User::create(array('email' => 'Admin@Fake.com', 'password' => Hash::make('secret'), 'level' => 2));
	}

}
