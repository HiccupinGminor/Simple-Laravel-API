<?php

class HotelTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('hotels')->truncate();

		// Uncomment the below to run the seeder
	    Hotel::create(array('name' => 'The Lantern Inn', 'brand_id' => 2, 'zip' => 82010));
	    Hotel::create(array('name' => 'Countryside Suites', 'brand_id' => 4, 'zip' => 42500));
	    Hotel::create(array('name' => 'The Garden Hotel, Phoenix', 'brand_id' => 3, 'zip' => 86000));
	    Hotel::create(array('name' => 'Fairway Hotel', 'brand_id' => 2, 'zip' => 93240));
	    Hotel::create(array('name' => 'Plainview Inn', 'brand_id' => 2, 'zip' => 65001));
	    Hotel::create(array('name' => 'Flyaway Hotel', 'brand_id' => 1, 'zip' => 23450));
	}

}
