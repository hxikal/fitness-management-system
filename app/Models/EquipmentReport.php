<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentReport extends Model
{

public $timestamps = true;

protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    // You MUST add this for the controller to save data into the database
   protected $fillable = [
    'user_id',
    'equip_name',
    'urgency',
    'description',
    'status',
    'image',
];




 

public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}
}