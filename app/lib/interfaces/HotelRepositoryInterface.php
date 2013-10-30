<?php namespace Interfaces;

/**
 * A contract to which all data implementations must adhere.
 * Allows for easy switching in the future.
 */
Interface HotelRepositoryInterface {

	public function all();
	public function find($id);
	public function create($input);
	public function update($id, $data);
	public function delete($id);
}