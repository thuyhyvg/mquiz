<?php namespace Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MonhocRequest extends FormRequest {

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
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'ten_mon_hoc' => 'required'
		];
	}

	public function messages()
	{
		return [
			'ten_mon_hoc.required' => 'Tên môn học đang trống bạn ơi'
		];
	}

}
