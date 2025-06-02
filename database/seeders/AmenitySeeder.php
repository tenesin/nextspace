<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    public function run(): void
    {
        $amenities = [
            'WiFi', 'Parking', 'Projector', 'Whiteboard', 'Coffee Machine',
            'Private Booths', 'Outdoor Seating', '24/7 Access', 'Meeting Rooms',
            'Printer', 'Scanner', 'Lounge Area', 'Kitchenette', 'Lockers'
        ];

        foreach ($amenities as $amenity) {
            Amenity::firstOrCreate(['name' => $amenity]);
        }
    }
}
