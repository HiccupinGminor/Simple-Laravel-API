<?php namespace Validators;

use Validators\BaseValidator;

/**
 * This class contains all of the validation knowledge for hotel data
 * Rather than integrating this class into the controller, this business 
 * logic should be stored in a separate Validator Service such as this one,
 * or in the appropriate model.
 */
class HotelValidator extends BaseValidator {

	public $rules = array(
		'name' => 'required|max:50',
		'brand_id' => 'required|integer',
		'zip' => 'required|integer',
	);

}