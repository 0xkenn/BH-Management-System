<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class School extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'school_name',
        'password',
    ];
}
