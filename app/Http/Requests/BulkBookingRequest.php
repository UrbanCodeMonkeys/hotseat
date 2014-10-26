<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkBookingRequest extends FormRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'desk_id' => 'required|exists:desks,id',
			'user_id' => 'required|exists:users,id',
			'start_date' => 'required|date',
			'end_date' => 'date'
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

}
