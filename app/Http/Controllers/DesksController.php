<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Carbon\Carbon;
use App\Contracts\Booking;
use App\Contracts\Desk;
use App\User;
use App\Http\Requests\BookingRequest;

class DesksController extends Controller {

	public function __construct(Carbon $carbon, Desk $desk, Booking $booking, User $user)
	{
		$this->carbon = $carbon;
		$this->desk = $desk;
		$this->booking = $booking;
		$this->user = $user;
	}

	/**
	 * @Get("/desks")
	 */
	public function index()
	{
		$now = $this->carbon->now();
		$start_date = $now->addWeek();
		if($start_date->day != 1) $start_date->previous(1);
		$end_date = $start_date->copy()->next(0);
		$desks = $this->desk->with(['bookings' => function($query) use ($start_date, $end_date)
			{
				$query->where('date', '>=', $start_date)->where('date', '<=', $end_date);	
			}])->get();
		$result = [
			'status' => 'ok',
			'desks' => $desks->toArray(),
		];
		return response()->json($result);
	}

	/**
	 * @Post("/desks/book")
	 */
	public function book(BookingRequest $request)
	{
		$booking_data = [
			'desk_id' => $request->input('desk_id'),
			'user_id' => $request->input('user_id')
		];
		$current_date = $this->carbon->createFromFormat('Y-m-d', $request->input('start_date'));
		$end_date = ($request->input('end_date')) ? $this->carbon->createFromFormat('Y-m-d', $request->input('end_date')) : $current_date;
		$bookings = [];
		while($current_date <= $end_date)
		{
			$booking = $this->booking->create(array_merge(
				$booking_data,
				['date' => $current_date]
			));
			$bookings[] = $booking;
			$current_date->addWeek();
			//$booking->save();
		}
		$result = [
			'status' => 'ok',
			'bookings' => $bookings,
		];
		return response()->json($result);
	}

}
