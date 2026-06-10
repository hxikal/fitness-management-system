<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TrainerBooking extends Model
{
    use HasFactory;

protected $fillable = [
    'user_id',
    'trainer_id',
    'trainer_name',
    'activity',
    'booking_date',
    'start_time',
    'end_time',
    'booking_time',
    'status',
];

 public $timestamps = false; // disables created_at / updated_at

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }
}