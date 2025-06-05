<?php

namespace Database\Factories;

use App\Models\Nextspace;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Amenity;
use App\Models\Service;
use App\Models\TimeSlot;

class NextspaceFactory extends Factory
{
    protected $model = Nextspace::class;

    public function definition(): array
    {
        $allAmenityIds = Amenity::pluck('id')->toArray();
        $allServiceIds = Service::pluck('id')->toArray();
        $allTimeSlotIds = TimeSlot::pluck('id')->toArray();

        return [
            'title' => $this->faker->company . ' ' . $this->faker->suffix,
            'description' => $this->faker->paragraph(3),
            'image' => 'https://picsum.photos/seed/' . $this->faker->word . '/1200/400',
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'hours' => json_encode([$this->faker->dayOfWeek . '-' . $this->faker->dayOfWeek . ': ' . $this->faker->time('h:i A') . ' - ' . $this->faker->time('h:i A')]),
            'rating' => $this->faker->randomFloat(1, 2.0, 5.0),
            'reviews_count' => $this->faker->numberBetween(10, 500),
            'amenities' => json_encode($this->faker->randomElements($allAmenityIds, $this->faker->numberBetween(2, 5))),
            'services' => json_encode($this->faker->randomElements($allServiceIds, $this->faker->numberBetween(1, 3))),
            'time_slots' => json_encode($this->faker->randomElements($allTimeSlotIds, $this->faker->numberBetween(1, 3))),
            'base_price' => $this->faker->randomFloat(2, 25, 200),
        ];
    }
}
