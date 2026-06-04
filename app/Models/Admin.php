<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


#[Fillable(['name', 'email', 'password'])]
class Admin extends Authenticatable
{
    //
    protected $hidden = ['password'];
}
