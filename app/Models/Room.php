<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'price',
        'room_image',
    ];

    public function boarding_house(): BelongsTo {
        return $this->belongsTo(BoardingHouse::class);
    }
}
 