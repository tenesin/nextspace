<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nextspace_id',
        'booking_id',
        'nextspace_title',
        'nextspace_address',
        'nextspace_image_url',
        'booked_time_slot',
        'booked_for',
        'booking_date',
        'price',
        'status',
        'selected_services_details', // Add this new column
    ];

    protected $casts = [
        'booked_for' => 'date',
        'booking_date' => 'date',
        'price' => 'decimal:2',
        'selected_services_details' => 'array', // Cast to array
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bookings() // or orders()
    {
        return $this->hasMany(Booking::class); // or Order::class
    }
}
