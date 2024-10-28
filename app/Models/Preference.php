<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'category',
        'name',
    ];

    // Casting fields to desired data types
    protected $casts = [
        'category' => 'string', // Cast to string
        'name' => 'string',      // Cast to string
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_preferences');
    }

    // Relationship with boarding houses
    public function boardingHouses()
    {
        return $this->belongsToMany(BoardingHouse::class, 'bh_preferences');
    }
}
