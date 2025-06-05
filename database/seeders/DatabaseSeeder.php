<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AmenitySeeder::class,
            ServiceSeeder::class,
            TimeSlotSeeder::class, // Ensure this line is present
            NextspaceSeeder::class,
        ]);
    }
}
