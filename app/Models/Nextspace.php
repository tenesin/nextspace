<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\NextspaceHour;

class Nextspace extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'address',
        'phone',
        'rating',
        'reviews_count',
        'base_price',
    ];

    protected $casts = [
        'rating' => 'float',
        'base_price' => 'decimal:2',
    ];

    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class, 'nextspace_amenity');
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'nextspace_service');
    }

    public function timeSlots(): BelongsToMany
    {
        return $this->belongsToMany(TimeSlot::class, 'nextspace_time_slot');
    }
    
    public function hours()
    {
        return $this->hasMany(NextspaceHour::class, 'nextspace_id');
    }
}