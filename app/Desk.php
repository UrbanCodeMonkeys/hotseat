<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\Desk as DeskContract;

class Desk extends Model implements DeskContract {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'desks';

	public function bookings()
	{
		$this->hasMany('Booking');
	}

}
