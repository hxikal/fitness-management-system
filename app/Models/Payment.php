<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Payment extends Model
{
 protected $fillable = [
    'user_id',
    'bill_code',
    'transaction_id',
    'plan',
    'method',
    'amount',
    'status',
    'receipt_path'
];
    public function user()
{
    return $this->belongsTo(User::class);
}
}

