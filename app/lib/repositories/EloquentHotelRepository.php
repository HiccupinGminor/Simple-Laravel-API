<?php namespace Repositories;

use Interfaces\HotelRepositoryInterface;
use Hotel;

class EloquentHotelRepository implements HotelRepositoryInterface {

	public function all()
	{
		return Hotel::all()->toArray();
	}

	public function find($id)
	{
		$hotel = Hotel::find($id);
		
		if(is_null($hotel))
		{
			return false;
		}
		
		return $hotel->toArray();
	}

	public function create($input)
	{
		$input = \Input::all();
		
		return Hotel::create($input);
	}

	public function update($id, $data)
	{
		$hotel = Hotel::find($id);
		
		if(is_null($hotel))
		{
			return false;
		}

		$hotel->update($data);

		return true;
	}

	public function delete($id)
	{
		$hotel = Hotel::find($id);

		if(is_null($hotel))
		{
			return false;
		}
		
		Hotel::destroy($id);

		return true;
	}
}