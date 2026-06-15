<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainerSession extends Model
{
    protected $table = 'trainer_sessions';
 
    protected $fillable = [
        'trainer_id',
        'trainer_name',
        'session_date',
        'start_time',
        'end_time',
        'activity',
        'status',
    ];
}