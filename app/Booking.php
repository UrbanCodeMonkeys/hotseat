<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\Booking as BookingContract;
use App\Contracts\Desk as Desk;

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

	public function setDateAttribute(\Carbon\Carbon $carbon)
	{
		$this->attributes['date'] = $carbon->format('Y-m-d');
	}

	public function getDateAttribute()
	{
		return \Carbon\Carbon::createFromFormat('Y-m-d', $this->attributes['date']);
	}

	public function scopeCovering($query, $start_date, $end_date)
	{
		$query->where('date', '>=', $start_date)
			->where('date', '<=', $end_date)
			->orderBy('date', 'asc');
	}

	public function scopeOnDate($query, $date)
	{
		$query->where('date', '=', $date->toDateString());
	}

	public function scopeForDesk($query, Desk $desk)
	{
		$query->where('desk_id', '=', $desk->id);
	}

}
