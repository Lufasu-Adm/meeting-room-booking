<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'booking_date',
        'start_time',
        'end_time',
        'status',
    ];

    /**
     * Relasi: Booking milik satu user
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Relasi: Booking untuk satu ruang rapat
     */
    public function room()
    {
        return $this->belongsTo(\App\Models\Room::class);
    }
}