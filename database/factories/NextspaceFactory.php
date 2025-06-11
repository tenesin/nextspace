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
    return [
        'title' => $this->faker->company . ' ' . $this->faker->companySuffix,
        'description' => $this->faker->paragraph,
        'image' => $this->faker->imageUrl(1200, 400),
        'address' => $this->faker->address,
        'phone' => $this->faker->phoneNumber,
        // 'hours' => $this->faker->sentence, // REMOVE THIS LINE
        'rating' => $this->faker->randomFloat(1, 1, 5),
        'reviews_count' => $this->faker->numberBetween(0, 500),
        'base_price' => $this->faker->randomFloat(2, 10, 200),
    ];
    }
}
