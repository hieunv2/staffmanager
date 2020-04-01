<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\UpdateRoleRule;

class UserStoreRequest extends BaseRequest
{
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
            'email' => 'required|email|unique:users',
            'name' => 'required|min:3|max:255',
            'full_name' => 'max:255',
	        'password' => 'sometimes|min:6',
	        'password_confirmation' => 'required_with:password|same:password|min:6',
			'role' => ['required', new UpdateRoleRule()]
        ];
    }
}
