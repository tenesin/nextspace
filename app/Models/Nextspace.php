<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\NextspaceHour;

/**
 * Class Nextspace
 * @package App\Models
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $address
 * @property string $phone
 * @property float $rating
 * @property int $reviews_count
 * @property float $base_price
 * @property array|string|null $time_slots

 */

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

public function timeSlots()
{
    return $this->belongsToMany(TimeSlot::class, 'nextspace_time_slot')
        ->withPivot('capacity')
        ->withTimestamps();
}
    
    public function hours()
    {
        return $this->hasMany(NextspaceHour::class, 'nextspace_id');
    }

    
}