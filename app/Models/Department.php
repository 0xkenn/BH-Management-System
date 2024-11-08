<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'department_name',
        'abbrev'
    ];

    public function programs():HasMany{
      return  $this->hasMany(Program::class);
    }
}
