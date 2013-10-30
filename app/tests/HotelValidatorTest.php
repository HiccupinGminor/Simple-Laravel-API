<?php 

use Validators\HotelValidator;

class HotelValidatorTest extends TestCase {

	protected $validator;

	public function setUp()
	{
		parent::setUp();

		$this->validator = new HotelValidator;
	}

	public function testNameIsRequired()
	{
		$result = $this->validator->validate(['name' => null, 'brand_id' => 1, 'zip' => 230450]);

		$this->assertFalse($result, "Expect that validator will fail with no name attribute");

		$this->assertNotNull($this->validator->getErrors());
	}

	public function testBrandIdIsRequired()
	{
		$result = $this->validator->validate(['name' => 'Coconut Inn', 'brand_id' => null, 'zip' => 230450]);

		$this->assertFalse($result, "Expect that validator will fail with no brand_id attribute");

		$this->assertNotNull($this->validator->getErrors());
	}

	public function testZipRequired()
	{
		$result = $this->validator->validate(['name' => 'Coconut Inn', 'brand_id' => 1, 'zip' => null]);

		$this->assertFalse($result, "Expect that validator will fail with no zip attribute");

		$this->assertNotNull($this->validator->getErrors());
	}

}