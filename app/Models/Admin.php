<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
   
    protected $table = 'users';   // ✅ point to users table
    protected $fillable = ['name','email','password','role'];
}
