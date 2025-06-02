<?php

namespace Database\Factories;

use App\Models\Nextspace;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Amenity; // Import Amenity model
use App\Models\Service; // Import Service model

class NextspaceFactory extends Factory
{
    protected $model = Nextspace::class;

    public function definition(): array
    {
        // Get all amenity and service IDs
        $allAmenityIds = Amenity::pluck('id')->toArray();
        $allServiceIds = Service::pluck('id')->toArray();
        $timeSlots = ["08:00 AM", "09:00 AM", "10:00 AM", "11:00 AM", "12:00 PM", "01:00 PM", "02:00 PM", "03:00 PM", "04:00 PM", "05:00 PM"];

        return [
            'title' => $this->faker->company . ' ' . $this->faker->suffix,
            'description' => $this->faker->paragraph(3),
            'image' => 'https://picsum.photos/seed/' . $this->faker->word . '/1200/400',
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'hours' => $this->faker->dayOfWeek . '-' . $this->faker->dayOfWeek . ': ' . $this->faker->time('h:i A') . ' - ' . $this->faker->time('h:i A'),
            'rating' => $this->faker->randomFloat(1, 2.0, 5.0),
            'reviews_count' => $this->faker->numberBetween(10, 500),
            'amenities' => json_encode($this->faker->randomElements($allAmenityIds, $this->faker->numberBetween(2, 5))), // Store IDs as JSON
            'services' => json_encode($this->faker->randomElements($allServiceIds, $this->faker->numberBetween(1, 3))),   // Store IDs as JSON
            'time_slots' => json_encode($this->faker->randomElements($timeSlots, $this->faker->numberBetween(3, 6))),
            'base_price' => $this->faker->randomFloat(2, 25, 200),
        ];
    }
}
