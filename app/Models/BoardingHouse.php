<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BoardingHouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'background_image',
    ];

    public function rooms(): HasMany{
        return $this->hasMany(Room::class);
    }
}