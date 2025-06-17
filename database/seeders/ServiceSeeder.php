<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $servicesData = [
            ['name' => 'Day Pass', 'price' => 35000],
            ['name' => 'Akses Ruang Meeting', 'price' => 60000],
            ['name' => 'Sewa Kantor Pribadi', 'price' => 450000],
            ['name' => 'Virtual Office', 'price' => 90000],
            ['name' => 'Sewa Ruang Event', 'price' => 300000],
            ['name' => 'Layanan Print', 'price' => 2000],
            ['name' => 'Bar Kopi & Teh', 'price' => 15000],
            ['name' => 'Penanganan Surat', 'price' => 25000],
        ];
        foreach ($servicesData as $serviceData) {
            Service::firstOrCreate(['name' => $serviceData['name']], ['price' => $serviceData['price']]);
        }
    }
}