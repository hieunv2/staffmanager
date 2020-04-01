<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
use SMartins\PassportMultiauth\HasMultiAuthApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasMultiAuthApiTokens, HasRoles;
  
  protected $hidden = [
    'password',
    'remember_token'
  ];
  
  protected $fillable = [
    'name',
    'full_name',
    'email',
    'password',
//    'remember_token'
  ];

    protected $guard_name = 'api';

    protected $appends = ['role'];


    protected function getRoleAttribute() {
      return $this->roles->first();
    }

    public function setPasswordAttribute($value){

        $this->attributes['password'] = Hash::make($value);
    }
}
