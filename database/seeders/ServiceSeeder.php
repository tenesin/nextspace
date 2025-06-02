<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $servicesData = [
            ['name' => 'Day Pass', 'price' => 30.00],
            ['name' => 'Meeting Room Access', 'price' => 50.00],
            ['name' => 'Private Office Rental', 'price' => 400.00],
            ['name' => 'Virtual Office', 'price' => 80.00],
            ['name' => 'Event Space Rental', 'price' => 250.00],
            ['name' => 'Printing Services', 'price' => 5.00],
            ['name' => 'Coffee & Tea Bar', 'price' => 10.00],
            ['name' => 'Mail Handling', 'price' => 20.00],
        ];
        foreach ($servicesData as $serviceData) {
            Service::firstOrCreate(['name' => $serviceData['name']], ['price' => $serviceData['price']]);
        }
    }
}
