<?php namespace Repositories;

use Interfaces\HotelRepositoryInterface;
use Hotel;

/**
 * This class handles the interaction between the routing layer (Controller) and the data layer (Model). 
 * It contains custom methods so that the Controller won't have to be dirtied by business logic.
 * 
 * The reason these methods aren't in a Model is for the sake of future flexibility:
 * If in the future a switch needs to be made from Laravel's SQL data implementation (Eloquent)
 * to NoSQL for example, making the switch will be no more difficult than creating a new repository 
 * for the new data access method.
 */
class EloquentHotelRepository implements HotelRepositoryInterface {

	/**
	 * Finds all hotel records
	 * @return array
	 */
	public function all()
	{
		return Hotel::all()->toArray();
	}

	/**
	 * Finds one hotel record by id
	 * @param  int $id
	 * @return array
	 */
	public function find($id)
	{
		$hotel = Hotel::find($id);
		
		if(is_null($hotel))
		{
			return false;
		}
		
		return $hotel->toArray();
	}

	/**
	 * Saves a hotel record
	 * @param  array $input
	 * @return array inserted record
	 */
	public function create($input)
	{
		$input = \Input::all();
		
		return Hotel::create($input);
	}

	/**
	 * Edit and save a record
	 * @param  int $id
	 * @param  array $data
	 * @return boolean whether or not save was successful
	 */
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

	/**
	 * Find and delete a record
	 * @param  int $id
	 * @return boolean wheter or not delete was successful
	 */
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