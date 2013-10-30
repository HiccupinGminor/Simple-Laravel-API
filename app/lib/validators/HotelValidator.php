<?php namespace Validators;

use Validators\BaseValidator;

class HotelValidator extends BaseValidator {

	public $rules = array(
		'name' => 'required|max:50',
		'brand_id' => 'required|integer',
		'zip' => 'required|integer',
	);

}