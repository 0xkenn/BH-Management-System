<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BoardingHouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'name',
        'address',
        'description',
        'business_permit_image',
        'background_image',
    ];
    

    public function rooms(): HasMany{
        return $this->hasMany(Room::class);
    }
    public function owner(){
        return $this->belongsTo(Owner::class, 'owner_id');
    }
    public function preferences()
    {
        return $this->belongsToMany(Preference::class, 'bh_preferences');
    }
    public function studentCount()
    {
        return User::where('is_student', 1)
                   ->where('boarding_house_id', $this->id)
                   ->count();
    }
    public function students()
    {
        return $this->hasManyThrough(
            User::class,          // Final model (users table)
            savedRoom::class,     // Intermediate model (saved_rooms table)
            'room_id',            // Foreign key on saved_rooms table (room_id)
            'id',                 // Foreign key on users table (id)
            'id',                 // Local key on boarding_houses table (id)
            'user_id'             // Local key on saved_rooms table (user_id)
        )->where('is_approved', 1);  // Include only approved students
    }

}
