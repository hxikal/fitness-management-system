<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'user_id',
        'membership_type',
        'start_date',
        'end_date',
        'status',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}