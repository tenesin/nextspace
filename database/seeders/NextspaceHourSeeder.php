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
            NextspaceHour::create([
                'nextspace_id' => $nextspace->id,
                'day_type' => 'mon-fri',
                'open_time' => '08:00',
                'close_time' => '18:00',
            ]);
            NextspaceHour::create([
                'nextspace_id' => $nextspace->id,
                'day_type' => 'sat-sun',
                'open_time' => '09:00',
                'close_time' => '17:00',
            ]);
        }
    }
}