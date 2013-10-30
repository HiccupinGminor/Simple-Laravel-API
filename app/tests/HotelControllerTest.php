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
		$this->assertJson($response->getContent());
	}

	public function testShowGetsHotelById()
	{
		$this->hotel->shouldReceive('find')->once()->with(1)->andReturn(true);
		$this->app->instance('Interfaces\HotelRepositoryInterface', $this->hotel);

		$response = $this->call('GET', 'api/v1/hotels/1');

		$this->assertResponseOk();
		$this->assertJson($response->getContent());
	}

	public function testShowReturns404IfHotelIsNotFound()
	{
		$this->hotel->shouldReceive('find')->once()->with(1)->andReturn(false);
		$this->app->instance('Interfaces\HotelRepositoryInterface', $this->hotel);

		$response = $this->call('GET', 'api/v1/hotels/1');

		$this->assertResponseStatus(404);
		$this->assertJson($response->getContent());
	}

	public function testStoreCreatesHotelAndCallsValidator()
	{
		$input = ['name' => 'Foo'];

		$this->hotel->shouldReceive('create')->once()->andReturn('created');
		$this->validator->shouldReceive('validate')->once()->with($input)->andReturn(true);
		
		$this->app->instance('Validators\HotelValidator', $this->validator);
		$this->app->instance('Interfaces\HotelRepositoryInterface', $this->hotel);

		$response = $this->call('POST', 'api/v1/hotels', $input);

		$this->assertResponseOk();
		$this->assertJson($response->getContent());
	}

	public function testStoreReturns400OnFailure()
	{
		$input = ['name' => 'Foo'];

		$this->hotel->shouldReceive('create')->never()->andReturn('created');
		$this->validator->shouldReceive('validate')->once()->with($input)->andReturn(false);
		
		$this->app->instance('Validators\HotelValidator', $this->validator);
		$this->app->instance('Interfaces\HotelRepositoryInterface', $this->hotel);

		$response = $this->call('POST', 'api/v1/hotels', $input);

		$this->assertResponseStatus(400);
		$this->assertJson($response->getContent());
	}

	public function testDestroyCallsHotelFindMethodAndDeleteMethod()
	{
		$this->hotel->shouldReceive('find')->once()->with(1)->andReturn(true);
		$this->hotel->shouldReceive('delete')->once()->with(1)->andReturn(true);
		$this->app->instance('Interfaces\HotelRepositoryInterface', $this->hotel);

		$response = $this->call('DELETE', 'api/v1/hotels/1');

		$this->assertResponseOk();
		$this->assertJson($response->getContent());
	}

	public function testDestroyReturns404IfHotelIsNotFound()
	{
		$this->hotel->shouldReceive('find')->once()->with(1)->andReturn(false);
		$this->hotel->shouldReceive('delete')->never();
		$this->app->instance('Interfaces\HotelRepositoryInterface', $this->hotel);

		$response = $this->call('DELETE', 'api/v1/hotels/1');

		$this->assertResponseStatus(404);
		$this->assertJson($response->getContent());
	}

	public function testUpdateCallsHotelUpdateMethod()
	{
		$input = ['name' => 'Foo'];

		$this->hotel->shouldReceive('update')->once()->with(1, $input)->andReturn('updated');
		$this->validator->shouldReceive('validate')->once()->with($input)->andReturn(true);
		
		$this->app->instance('Interfaces\HotelRepositoryInterface', $this->hotel);
		$this->app->instance('Validators\HotelValidator', $this->validator);

		$response = $this->call('PUT', 'api/v1/hotels/1', $input);

		$this->assertResponseOk();
		$this->assertJson($response->getContent());
	}

	public function testUpdateReturns404IfHotelIsNotFound()
	{
		$input = ['name' => 'Foo'];

		$this->hotel->shouldReceive('update')->once()->with(1, $input)->andReturn(false);
		$this->validator->shouldReceive('validate')->once()->with($input)->andReturn(true);
		
		$this->app->instance('Interfaces\HotelRepositoryInterface', $this->hotel);
		$this->app->instance('Validators\HotelValidator', $this->validator);

		$response = $this->call('PUT', 'api/v1/hotels/1', $input);

		$this->assertResponseStatus(404);
		$this->assertJson($response->getContent());
	}

	public function testUpdateReturns400IfValidationDoesNotPass()
	{
		$input = ['name' => 'Foo'];

		$this->hotel->shouldReceive('update')->never();
		$this->validator->shouldReceive('validate')->once()->with($input)->andReturn(false);
		
		$this->app->instance('Interfaces\HotelRepositoryInterface', $this->hotel);
		$this->app->instance('Validators\HotelValidator', $this->validator);

		$response = $this->call('PUT', 'api/v1/hotels/1', $input);

		$this->assertResponseStatus(400);
		$this->assertJson($response->getContent());
	}

}