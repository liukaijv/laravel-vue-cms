<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    protected $fillable = ['name', 'email', 'password', 'image'];

    protected $hidden = ['is_super', 'password', 'remember_token', 'login_token'];

}
