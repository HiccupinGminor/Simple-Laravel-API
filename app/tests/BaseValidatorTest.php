<?php 

use Validators\TestValidator;
use \Validator as Validator;

class BaseValidatorTest extends TestCase {

	protected $validator;

	public function setUp()
	{
		parent::setUp();

		$this->validator = new TestValidator;
	}

	public function tearDown()
	{
		Mockery::close();
	}

	public function testValidateReturnsTrueOnSuccess()
	{		
		Validator::shouldReceive('make')->once()->andReturn(Mockery::mock(['passes' => true]));

		$result = $this->validator->validate();

		$this->assertTrue($result, 'Expect that validate method should return true if the Laravel Validator passes method returns true');
	}

	public function testValidateReturnsFalseOnFailure()
	{
		Validator::shouldReceive('make')->once()->andReturn(Mockery::mock(['passes' => false, 'messages' => 'Error']));

		$result = $this->validator->validate();

		$this->assertFalse($result, 'Expect that validate method should return false if the Laravel Validator passes method returns false');
		
		$this->assertEquals( 'Error', $this->validator->getErrors(), 'Expect that validate method return error messages on failure');
	}

}