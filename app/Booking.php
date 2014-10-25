<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\Booking as BookingContract;

class Booking extends Model implements BookingContract {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'bookings';

	public function desk()
	{
		$this->belongsTo('Desk');
	}

}
