<?php

namespace Database\Seeders;

use App\Models\Nextspace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NextspaceSeeder extends Seeder
{
    public function run(): void
    {
        Nextspace::factory()->count(10)->create(); // No more attaching here
    }
}
