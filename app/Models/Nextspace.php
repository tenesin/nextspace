<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Nextspace extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'address',
        'phone',
        'hours',
        'rating',
        'reviews_count',
        'amenities', 
        'services', 
        'time_slots',
        'base_price',
    ];

    protected $casts = [
        'amenities' => 'array', 
        'services' => 'array', 
        'time_slots' => 'array',
        'base_price' => 'decimal:2',
    ];

    // Keep these relationships for fetching names and for admin form pre-selection
    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class, 'nextspace_amenity');
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'nextspace_service');
    }
}
