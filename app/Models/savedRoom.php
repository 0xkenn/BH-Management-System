<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class savedRoom extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'room_id',
    ];

    public function room(){
        return $this->belongsTo(Room::class);
    }
    protected function user(){
        return $this->belongsTo(User::class);
    }
}
