<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'program_name',
        'abbrev',
    ];

    public function department(): BelongsTo{
        return $this->belongsTo(Department::class);
    }

    public function student():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
