<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\UpdateRoleRule;

class UserUpdateRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      /** @var User $updatingUser */
      $admin = \Auth::user();
      $updatingUser = User::find($this->get('id'));
      if (!$admin || !$updatingUser) return false;
      $adminRole = optional($admin->role)->level;
      $updatingUserRole = optional($updatingUser->role)->level;
      
      return $adminRole >= $updatingUserRole;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'exists:users',
            'email' => "unique:users,email,$this->id,id",
            'name' => 'required|min:3|max:255',
            'full_name' => 'max:255',
            'password' => 'nullable|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6',
            'role' => ['required', new UpdateRoleRule()]
        ];
    }
}
