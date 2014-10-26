<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\User;

class UsersController extends Controller {

	public function __construct(User $users)
	{
		$this->users = $users;
	}

	/**
	 * @Get("/users")
	 */
	public function index()
	{
		$users = $this->users->all();
		$result = [
			'status' => 'ok',
			'users' => $users->toArray(),
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
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * @Get("/users/{id}")
	 */
	public function show($id)
	{
		$user = $this->users->find($id);
		$result = [
			'user'     => $user->toArray(),
			'bookings' => $user->bookings->toArray(),
		];
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
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
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
