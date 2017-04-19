<?php namespace Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest {

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
			'name' => 'required',
			'email' => 'required|unique:users,email',
			'password' => 'required',
			're_password' => 'same:password'
		];
	}

	public function messages()
	{
		return [
			'name.required' => 'Không được bỏ trống họ tên',
			'email.required' => 'Không được bỏ trống email',
			'email.unique' => 'Email này đã tồn tại',
			'password.required' => 'Phải nhập password',
			're_password.same' => 'Hai password không giống nhau'
		];
	}

}
