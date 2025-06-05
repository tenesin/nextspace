<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;

    protected $fillable = ['slot'];

    public function nextSpaces()
    {
        return $this->hasMany(NextSpace::class, 'time_slots');
    }
}