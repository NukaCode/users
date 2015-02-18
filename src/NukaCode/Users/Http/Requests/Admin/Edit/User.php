<?php namespace NukaCode\Users\Http\Requests\Admin\Edit;

use Illuminate\Support\Facades\Auth;
use NukaCode\Core\Http\Requests\BaseRequest;

class User extends BaseRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'username' => 'required',
			'email'    => 'required|email',
			'roles'    => 'required|array'
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		// @todo Fix this once logins are working
		return true;
		//return Auth::check() && Auth::user()->checkPermission('SITE_ADMIN');
	}

}
