<?php

    namespace Database\Seeders;

    use App\Models\TimeSlot;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;

    class TimeSlotSeeder extends Seeder
    {
        public function run(): void
        {
            $timeSlots = [
                '08:00 AM', '09:00 AM', '10:00 AM', '11:00 AM', '12:00 PM',
                '01:00 PM', '02:00 PM', '03:00 PM', '04:00 PM', '05:00 PM',
                '06:00 PM', '07:00 PM', '08:00 PM'
            ];

            foreach ($timeSlots as $slot) {
                TimeSlot::firstOrCreate(['slot' => $slot]);
            }
        }
    }
    