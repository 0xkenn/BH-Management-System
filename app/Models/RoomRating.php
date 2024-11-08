<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomRating extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'user_id', 'rating'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
