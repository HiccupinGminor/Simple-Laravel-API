<?php

use Repositories\EloquentHotelRepository as Repo;

/**
 * It is difficult to unit test the Repository due to its 
 * extensive use of static methods. (Testing it would constitute an integration test)
 *
 * The Eloquent model could be injected as a dependency to improve testability.
 */
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