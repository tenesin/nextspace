<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    public function run(): void
    {
        $amenities = [
            'WiFi', 'Parkir', 'Proyektor', 'Papan Tulis', 'Mesin Kopi',
            'Ruang Pribadi', 'Area Outdoor', 'Akses 24 Jam', 'Ruang Meeting',
            'Printer', 'Scanner', 'Area Santai', 'Dapur Mini', 'Loker'
        ];

        foreach ($amenities as $amenity) {
            Amenity::firstOrCreate(['name' => $amenity]);
        }
    }
}