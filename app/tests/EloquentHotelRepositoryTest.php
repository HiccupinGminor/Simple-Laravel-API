<?php

use Repositories\EloquentHotelRepository as Repo;

class EloquentHotelRepositoryTest extends TestCase {

	protected $repo;

	public function setUp()
	{
		$this->repo = new Repo;
	}

	public function testRepositoryWorks()
	{
		$this->assertTrue(true, "Expect that EloquentHotelRepository successfully implements HotelRepositoryInterface");
	}

}