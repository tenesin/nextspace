<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nextspace;
use App\Models\NextspaceHour;

class NextspaceHourSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Nextspace::all() as $nextspace) {
            // You can randomize or add multiple hours if you want
            NextspaceHour::create([
                'nextspace_id' => $nextspace->id,
                'day' => 'Monday-Friday',
                'open_time' => '08:00',
                'close_time' => '18:00',
            ]);
            NextspaceHour::create([
                'nextspace_id' => $nextspace->id,
                'day' => 'Saturday-Sunday',
                'open_time' => '09:00',
                'close_time' => '17:00',
            ]);
        }
    }
}