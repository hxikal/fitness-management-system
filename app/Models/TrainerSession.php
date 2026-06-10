<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainerSession extends Model
{
    protected $fillable = [
        'trainer_name',
        'session_date',
        'session_time',
        'activity',
        'status',
    ];
}