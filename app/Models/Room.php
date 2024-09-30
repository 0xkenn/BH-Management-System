<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'boarding_house_id',
        'name',
        'capacity',
        'price',
        'room_image_1',
        'room_image_2',
        'room_image_3',
    ];

    public function boarding_house(): BelongsTo {
        return $this->belongsTo(BoardingHouse::class);
    }
}
 