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
            TimeSlotSeeder::class,
            NextspaceSeeder::class,
            NextspacePivotSeeder::class,
            NextspaceHourSeeder::class, // <-- Add this line

        ]);
    }
}