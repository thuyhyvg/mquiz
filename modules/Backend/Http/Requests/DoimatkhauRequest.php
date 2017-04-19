<?php namespace Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoimatkhauRequest extends FormRequest {

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
			'password' => 'required',
			'password1' => 'required',
			're_password' => 'same:password1'
		];
	}

	public function messages()
	{
		return [
			'password.required' => 'Phải nhập mật khẩu cũ',
			'password.unique' => 'Mật khẩu cũ không đúng',
			'password1.required' => 'Phải nhập mật khẩu mới',
			're_password.same' => 'Hai mật khẩu không giống nhau'
		];
	}

}
