<?php

namespace Database\Factories;

use App\Models\Nextspace;
use Illuminate\Database\Eloquent\Factories\Factory;

class NextspaceFactory extends Factory
{
    protected $model = Nextspace::class;

    public function definition(): array
    {
        $realPlaces = [
            [
                'title' => 'Historica Coffee & Pastry',
                'description' => 'Tempat nongkrong cozy dengan interior klasik, menawarkan kopi spesial, pastry, dan makanan barat serta Indonesia.',
                'address' => 'Jl. Sumatera No.40, Gubeng, Surabaya',
                'phone' => '+62 812-3456-7890',
            ],
            [
                'title' => 'Caturra Espresso',
                'description' => 'Cafe modern dengan suasana nyaman, cocok untuk kerja atau santai, menyajikan kopi spesial dan makanan ringan.',
                'address' => 'Jl. Anjasmoro No.32, Sawahan, Surabaya',
                'phone' => '+62 813-9876-5432',
            ],
            [
                'title' => 'Blackbarn Coffee',
                'description' => 'Cafe industrial dengan area indoor dan outdoor, terkenal dengan kopi manual brew dan aneka pastry.',
                'address' => 'Jl. Untung Suropati No.79, Tegalsari, Surabaya',
                'phone' => '+62 822-1234-5678',
            ],
            [
                'title' => 'One Pose Cafe',
                'description' => 'Cafe instagramable dengan dekorasi unik, menawarkan menu western dan dessert kekinian.',
                'address' => 'Jl. Puncak Permai II No.22, Sukomanunggal, Surabaya',
                'phone' => '+62 821-2345-6789',
            ],
            [
                'title' => 'Carpentier Kitchen',
                'description' => 'Cafe dan concept store dengan suasana homey, menyajikan makanan western, kopi, dan dessert.',
                'address' => 'Jl. Untung Suropati No.83, Tegalsari, Surabaya',
                'phone' => '+62 812-8765-4321',
            ],
            [
                'title' => 'Libreria Eatery',
                'description' => 'Cafe dengan konsep perpustakaan, cocok untuk belajar dan bekerja, menyediakan makanan sehat dan kopi.',
                'address' => 'Jl. Ngagel Jaya No.89, Gubeng, Surabaya',
                'phone' => '+62 812-3344-5566',
            ],
            [
                'title' => 'Kudos Cafe',
                'description' => 'Cafe minimalis dengan menu kopi spesial dan makanan ringan, suasana nyaman untuk nongkrong.',
                'address' => 'Jl. Indragiri No.18, Wonokromo, Surabaya',
                'phone' => '+62 813-2233-4455',
            ],
            [
                'title' => 'Redback Specialty Coffee',
                'description' => 'Tempat ngopi dengan specialty coffee dan aneka pastry, cocok untuk pecinta kopi sejati.',
                'address' => 'Jl. Raya Darmo Permai I No.38, Sukomanunggal, Surabaya',
                'phone' => '+62 822-5566-7788',
            ],
            [
                'title' => 'TBRK Rumah Kopi',
                'description' => 'Cafe dengan nuansa rumahan, menyediakan kopi lokal dan makanan tradisional Indonesia.',
                'address' => 'Jl. Taman Barunawati No.1, Krembangan, Surabaya',
                'phone' => '+62 811-2233-4455',
            ],
            [
                'title' => 'Kopi Titik Koma',
                'description' => 'Cafe kekinian dengan berbagai varian kopi dan minuman segar, tempat favorit anak muda.',
                'address' => 'Jl. Raya Darmo No.112, Wonokromo, Surabaya',
                'phone' => '+62 812-9988-7766',
            ],
        ];

        $place = $this->faker->randomElement($realPlaces);

        return [
            'title' => $place['title'],
            'description' => $place['description'],
            'image' => $this->faker->imageUrl(1200, 400),
            'address' => $place['address'],
            'phone' => $place['phone'],
            'rating' => $this->faker->randomFloat(1, 1, 5),
            'reviews_count' => $this->faker->numberBetween(0, 500),
            'base_price' => $this->faker->numberBetween(20000, 100000),
        ];
    }
}