<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Trainer extends Authenticatable
{
    // Explicitly tell Laravel to look for the 'trainers' table in your database
    protected $table = 'trainers';

  protected $fillable = [
    'name',
    'email',
    'phone',
    'password',
    'profile_image',
   
];

    protected $hidden = [
        'password', 'remember_token',
    ];
}