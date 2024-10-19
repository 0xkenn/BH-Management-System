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
    


}
