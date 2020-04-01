<?php

namespace App\Helper\UtilTrait;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait LoginUtilTrait
{
    /**
     * @return array
     */
    public function info()
    {
        $info = Auth::user();
        $roles = $info->getRoleNames();
        return compact('info', 'roles');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->token()->revoke();
        }
        return response()->json(null, 204);
    }
}
