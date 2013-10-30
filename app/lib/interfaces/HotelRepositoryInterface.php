<?php namespace Interfaces;

Interface HotelRepositoryInterface {

	public function all();
	public function find($id);
	public function create($input);
	public function update($id, $data);
	public function delete($id);
}