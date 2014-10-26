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

	protected $fillable = ['desk_id', 'user_id', 'date'];

	public function desk()
	{
		$this->belongsTo('Desk');
	}

	public function scopeCovering($query, $start_date, $end_date)
	{
		$query->where('date', '>=', $start_date)
			->where('date', '<=', $end_date)
			->orderBy('date', 'asc');
	}

}
