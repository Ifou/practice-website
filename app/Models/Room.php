<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_title',
        'room_description',
        'room_image',
        'room_price',
        'room_type',
        'room_status',
        'room_capacity',
        'room_wifi',
    ];
}
