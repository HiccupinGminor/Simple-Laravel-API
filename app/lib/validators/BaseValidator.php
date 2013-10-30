<?php namespace Validators;

abstract class BaseValidator {

	protected $input;
	protected $errors;
	public $rules;

	public function __construct($input = null)
	{
		$this->input = $input ?: \Input::all();
	}

	public function getErrors()
	{
		return $this->errors;
	}	

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