<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'profile_image',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'email',
        'age',
        'gender',
        'mobile_number',
        'parent',
        'is_student',
        'program_id',
        'region_code',           // Matches the name in the database and Blade form
        'province_code',         // Matches the name in the database and Blade form
        'city_municipality_code', // Matches the name in the database and Blade form
        'barangay_code',   // New field for barangay
        'password',
       
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function boardingHouse(): HasMany{
        return $this->hasMany(BoardingHouse::class);
    }
    public function reservations(){
        return $this->hasMany(savedRoom::class);
    }
    public function deleteAccount()
    {
        // Call the method to update room capacities before deletion
        $this->updateRoomCapacities();

        // Delete the user account
        $this->delete();
    }

    protected function updateRoomCapacities()
    {
        // Get the reserved rooms for this user
        $reservedRooms = $this->reservedRooms;

        foreach ($reservedRooms as $room) {
            // Increment capacity by 1
            $room->capacity += 1;

            // Update occupancy status if needed
            if ($room->capacity > 0) {
                $room->is_occupied = 0; //  0 means not occupied
            }

            // Save the updated room
            $room->save();
        }
    }
    public function preferences()
    {
        return $this->belongsToMany(Preference::class, 'user_preferences');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function program():BelongsTo{
        return $this->belongsTo(Program::class);
    }
}
