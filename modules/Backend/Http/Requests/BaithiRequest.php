<?php namespace Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaithiRequest extends FormRequest {

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
			'ten_bai_thi' => 'required',
			'ngay_thi' => 'required',
			'thoi_gian' => 'required',
			'so_cau_hoi' => 'required'
		];
	}

	public function messages()
	{
		return [
			'ten_bai_thi.required' => 'Bạn phải nhập tên bài thi.',
			'ngay_thi.required' => 'Bạn phải nhập ngày thi.',
			'thoi_gian.required' => 'Bạn phải nhập thời gian thi.',
			'so_cau_hoi.required' => 'Bạn phải nhập số câu hỏi của bài thi.'
		];
	}

}
