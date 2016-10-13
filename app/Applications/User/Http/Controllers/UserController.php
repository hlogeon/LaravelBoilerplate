<?php

namespace App\Applications\User\Http\Controllers;

use App\Domains\User\Entities\User;

class UserController extends BaseController
{
    public function index()
    {
        return User::all();
    }
}
