<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nextspace;
use App\Models\Amenity;
use App\Models\Service;
use App\Models\TimeSlot;

class NextspacePivotSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        $nextspaces = Nextspace::all();
        $amenityIds = Amenity::pluck('id')->all();
        $serviceIds = Service::pluck('id')->all();
        $timeSlotIds = TimeSlot::pluck('id')->all();

        foreach ($nextspaces as $nextspace) {
            // Attach random amenities (1-4)
            $nextspace->amenities()->sync(
                $faker->randomElements($amenityIds, rand(1, min(14, count($amenityIds))))
            );
            // Attach random services (1-3)
            $nextspace->services()->sync(
                $faker->randomElements($serviceIds, rand(1, min(8, count($serviceIds))))
            );
            // Attach random time slots (1-5)
            $nextspace->timeSlots()->sync(
                $faker->randomElements($timeSlotIds, rand(1, min(13, count($timeSlotIds))))
            );
        }
    }
}