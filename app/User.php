<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable,HasRoles;
//    protected $connection = 'mysql';

    protected $fillable = [
        'name', 'email', 'password','active'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


//    public function getRememberToken()
//    {
//        return null; // not supported
//    }
//
//    public function setRememberToken($value)
//    {
//        // not supported
//    }
//
//    public function getRememberTokenName()
//    {
//        return null; // not supported
//    }
//
//    /**
//     * Overrides the method to ignore the remember token.
//     */
//    public function setAttribute($key, $value)
//    {
//        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
//        if (!$isRememberTokenAttribute) {
//            parent::setAttribute($key, $value);
//        }
//    }
}
