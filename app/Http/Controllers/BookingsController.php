<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Carbon\Carbon;
use App\Contracts\Booking;
use App\Contracts\Desk;
use App\User;
use App\Http\Requests\CreateBookingRequest;
use App\Http\Requests\EditBookingRequest;
use App\Http\Requests\BulkBookingRequest;

class BookingsController extends Controller {

	public function __construct(Carbon $carbon, Booking $bookings, Desk $desks, User $users)
	{
		$this->users = $users;
		$this->desks = $desks;
		$this->bookings = $bookings;
		$this->carbon = $carbon;
	}

	/**
	 * @Get("/bookings")
	 */
	public function index()
	{
		$result = [
			'status' => 'ok',
			'bookings' => $this->bookings->all(),
		];
		return response()->json($result);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * @Post("/bookings")
	 */
	public function store(CreateBookingRequest $request)
	{
		$desk = $this->desks->findOrFail($request->input('desk_id'));
		$user = $this->users->findOrFail($request->input('user_id'));
		$date = $this->carbon->createFromFormat('Y-m-d', $request->input('date'));
		if($booking = $this->bookings->forDesk($desk)->onDate($date)->first())
		{
			$result = [
				'status' => 'nok',
				'error' => [
					'code' => 'already_booked',
					'details' => $booking->toArray()
				],
			];
		}
		else
		{
			$booking = new $this->bookings;
			$booking->desk_id = $desk->id;
			$booking->user_id = $user->id;
			$booking->date = $date;
			$booking->save();
			$result = [
				'status' => 'ok',
				'booking' => $booking->toArray(),
			];
		}
		return response()->json($result);
	}

	/**
	 * @Middleware("auth")
	 * @Put("/bookings/{id}")
	 */
	public function update($id, EditBookingRequest $request)
	{
		$booking = $this->bookings->find($id);
		if(!$booking) {
			$result = [
				'status' => 'nok',
				'error' => [
					'code' => 'booking_not_found',
					'details' => $id,
				],
			];
		}
		else
		{
			$booking->user_id = $request->input('user_id');
			$booking->save();
			$result = [
				'status' => 'ok',
				'booking' => $booking->toArray(),
			];
		}
		return response()->json($result);
	}

	/**
	 * @Post("/bookings/bulk")
	 */
	public function bulk(BulkBookingRequest $request)
	{
		$desk = $this->desks->findOrFail($request->input('desk_id'));
		$user = $this->users->findOrFail($request->input('user_id'));

		$start_date = $this->carbon->createFromFormat('Y-m-d', $request->input('start_date'));
		$end_date = ($request->input('end_date')) ? $this->carbon->createFromFormat('Y-m-d', $request->input('end_date')) : $start_date->copy();
		$bookings = [
			'new' => [],
			'occupied' => [],
		];
		$current_date = $start_date->copy();
		while($current_date->diffInSeconds($end_date, false) >= 0)
		{
			if($booking = $this->bookings->forDesk($desk)->onDate($current_date)->first())
			{
				$bookings['occupied'][] = $booking;
			}
			else
			{
				$booking = new $this->bookings;
				$booking->desk_id = $desk->id;
				$booking->user_id = $user->id;
				$booking->date = $current_date;
				$booking->save();
				$bookings['new'][] = $booking;
			}
			$current_date->addWeek();
		}
		$result = [
			'status' => 'ok',
			'bookings' => $bookings['new'],
			'occupied' => $bookings['occupied'],
		];
		return response()->json($result);
	}

	/**
	 * @Get("/bookings/{id}")
	 */
	public function show($id)
	{
		$booking = $this->bookings->find($id);
		if(!$booking) {
			$result = [
				'status' => 'nok',
				'error' => [
					'code' => 'booking_not_found',
					'details' => $id,
				],
			];
		}
		else
		{
			$result = [
				'status' => 'ok',
				'booking' => $booking->toArray(),
			];
		}
		return response()->json($result);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
