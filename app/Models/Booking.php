<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'room_id',
        'full_name',
        'number',
        'email',
        'start_date',
        'end_date',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
