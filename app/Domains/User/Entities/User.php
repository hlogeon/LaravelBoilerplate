<?php

namespace App\Domains\User\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 *
 * @SWG\Definition(required={"id", "name", "email", "password"})
 * @property $id int
 * @property $name string
 * @property $email string
 * @property $password string
 */
class User extends Authenticatable
{
    /**
     * @SWG\Property(type="integer", format="int64", property="id")
     * @SWG\Property(type="string", property="name")
     * @SWG\Property(type="string", property="email")
     * @SWG\Property(type="string", property="password")
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
