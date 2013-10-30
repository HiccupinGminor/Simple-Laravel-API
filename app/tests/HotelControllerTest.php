<?php 

use Mockery as M;

Class HotelControllerTest extends TestCase {

	protected $hotel;

	public function setUp()
	{
		parent::setUp();
		$this->hotel = M::mock('Interfaces\HotelRepositoryInterface');
		$this->validator = M::mock('Validators\HotelValidator');
	}

	public function tearDown()
	{
		M::close();
	}

	public function testIndexGetsAllHotels()
	{ 	
		$this->hotel->shouldReceive('all')->once()->andReturn('hotels');
		$this->app->instance('Interfaces\HotelRepositoryInterface', $this->hotel);

		$response = $this->call('GET', 'api/v1/hotels');
		
		$this->assertResponseOk();
	}

	public function testShowGetsHotelById()
	{
		$this->hotel->shouldReceive('find')->once()->with(1)->andReturn('found');
		$this->app->instance('Interfaces\HotelRepositoryInterface', $this->hotel);

		$response = $this->call('GET', 'api/v1/hotels/1');

		$this->assertResponseOk();
	}

	public function testStoreCreatesHotelAndCallsValidator()
	{
		$input = ['name' => 'Foo'];

		$this->hotel->shouldReceive('create')->once()->andReturn('created');
		$this->validator->shouldReceive('validate')->once()->with($input)->andReturn(true);
		
		$this->app->instance('Validators\HotelValidator', $this->validator);
		$this->app->instance('Interfaces\HotelRepositoryInterface', $this->hotel);

		$this->call('POST', 'api/v1/hotels', $input);

		$this->assertResponseOk();
	}

	public function testDestroyCallsHotelFindMethodAndDeleteMethod()
	{
		$this->hotel->shouldReceive('find')->once()->with(1)->andReturn(true);
		$this->hotel->shouldReceive('delete')->once()->with(1)->andReturn(true);
		$this->app->instance('Interfaces\HotelRepositoryInterface', $this->hotel);

		$this->call('DELETE', 'api/v1/hotels/1');

		$this->assertResponseOk();
	}

	public function testUpdateCallsHotelUpdateMethod()
	{
		$input = ['name' => 'Foo'];

		$this->hotel->shouldReceive('update')->once()->with(1, $input)->andReturn('updated');
		$this->validator->shouldReceive('validate')->once()->with($input)->andReturn(true);
		
		$this->app->instance('Interfaces\HotelRepositoryInterface', $this->hotel);
		$this->app->instance('Validators\HotelValidator', $this->validator);

		$this->call('PUT', 'api/v1/hotels/1', $input);

		$this->assertResponseOk();
	}

}