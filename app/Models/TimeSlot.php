<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;

    protected $fillable = ['slot'];

public function nextspaces()
{
    return $this->belongsToMany(Nextspace::class, 'nextspace_time_slot')
        ->withPivot('capacity')
        ->withTimestamps();
}
}