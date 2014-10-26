<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class DeskRequest extends FormRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'start_date' => 'date',
			'end_date' => 'date',
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

	/**
	 * Get the input that should be fed to the validator.
	 *
	 * @return array
	 */
	protected function formatInput()
	{
		$start_date = Carbon::now();
		if($start_date->day != 1) $start_date->previous(1);
		if($this->input('start_date'))
		{
			$start_date = Carbon::createFromFormat('Y-m-d', $this->input('start_date'));
		}
		$end_date = $start_date->copy()->next(0);
		if($this->input('end_date'))
		{
			$end_date = Carbon::createFromFormat('Y-m-d', $this->input('end_date'));
		}
		$this->merge(['start_date' => $start_date->toDateString(), 'end_date' => $end_date->toDateString()]);
		return $this->all();
	}

}
