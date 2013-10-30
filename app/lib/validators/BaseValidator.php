<?php namespace Validators;

/**
 * This abstract class is the parent class for all validators and
 * knows how to validate input against pre-specified rules
 * and return error messages.
 * 
 */
abstract class BaseValidator {

	protected $input;
	protected $errors;
	public $rules;

	public function __construct($input = null)
	{
		$this->input = $input ?: \Input::all();
	}

	/**
	 * Getter class for errors
	 * @return array error messages
	 */
	public function getErrors()
	{
		return $this->errors;
	}	

	/**
	 * Validation method
	 * @return boolean whether or not the validation passed
	 */
	public function validate()
	{
		$validation = \Validator::make($this->input, $this->rules);

		if($validation->passes())
		{
			return true;
		}

		$this->errors = $validation->messages();

		return false;
	}

}