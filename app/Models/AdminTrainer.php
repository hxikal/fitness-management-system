<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminTrainer extends Model
{
    // Explicitly tell Laravel which table this model maps to
    protected $table = 'admin_trainers';

    // Allow mass assignment for these fields
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];
}