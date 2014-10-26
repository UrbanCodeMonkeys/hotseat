<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Carbon\Carbon;
use App\Contracts\Desk;
use App\Http\Requests\DeskRequest;

class DesksController extends Controller {

	public function __construct(Carbon $carbon, Desk $desks)
	{
		$this->carbon = $carbon;
		$this->desks = $desks;
	}

	/**
	 * @Get("/desks")
	 */
	public function index(DeskRequest $request)
	{
		$desks = $this->desks->with(['bookings' => function($query) use ($request)
			{
				$query->where('date', '>=', $request->input('start_date'))
					->where('date', '<=', $request->input('end_date'));	
			}])->get();
		$result = [
			'status' => 'ok',
			'desks' => $desks->toArray(),
		];
		return response()->json($result);
	}

	/**
	 * @Get("/desks/{id}")
	 */
	public function show($id, DeskRequest $request)
	{
		$desk = $this->desks->with(['bookings' => function($query) use ($request)
			{
				$query->where('date', '>=', $request->input('start_date'))
					->where('date', '<=', $request->input('end_date'));	
			}])
			->where('id', '=', $id)
			->first();
		dd($desk);
		$result = [
			'result' => 'ok',
			'desk' => $desk->toArray()
		];
		return response()->json($result);
	}

}
