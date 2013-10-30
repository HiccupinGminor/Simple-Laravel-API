<?php
use Interfaces\HotelRepositoryInterface as Hotel;
use Validators\HotelValidator;

class HotelController extends BaseController {

	protected $hotel;
	protected $validator;

	public function __construct(Hotel $hotel, HotelValidator $hotelValidator)
	{
		$this->hotel = $hotel;
		$this->validator = $hotelValidator;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$hotels = $this->hotel->all();

		$content = json_encode(array('responseValid' => true, 'status' => 'Records retrieved', 'hotels' => $hotels));
		return Response::make($content, 200)
						->header('Content-type', 'application/json');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

		if($this->validator->validate($input))
		{
			$this->hotel->create($input); 
			return Response::json(['responseValid' => true, 'status' => 'Record created']);
		}
		return Response::json(['responseValid' => false, 'status' => 'Record failed to save'], 400);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $hotel = $this->hotel->find($id);

        if($hotel)
        {
			$content = json_encode(array('responseValid' => true, 'status' => 'Record retrieved', 'hotels' => $hotel));
			return Response::make($content, 200)
						->header('Content-type', 'application/json');
        }
    	return Response::json(['responseValid' => false, 'status' => 'No record found'], 404);
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();
		if($this->validator->validate($input))
		{
			$hotel = $this->hotel->update($id, $input); 
			
			if(!$hotel)
			{
				return Response::json(['responseValid' => false, 'status' => 'No record found'], 404);
			}
			return Response::json(['responseValid' => true, 'status' => 'Record updated'], 200);
		}
		return Response::json(['responseValid' => false, 'status' => 'Record failed to save'], 400);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$hotel = $this->hotel->find($id);

		if(!$hotel)
		{
			return Response::json(['responseValid' => false, 'status' => 'No record found'], 404);
		}
		$this->hotel->delete($id);
		return Response::json(['responseValid' => true, 'status' => 'Record deleted'], 200);
	}

}
