<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NextspaceController extends Controller
{
    private $nextspacesData = [
        1 => [
            'title' => 'The Creative Hub - North Miami Beach',
            'description' => 'A vibrant co-working space designed for innovation and collaboration, featuring modern amenities and inspiring views.',
            'image' => 'https://placehold.co/1200x400/FFFFFF/00B4D8?text=NextSpace+Banner+1',
            'address' => '3933 NE 163rd St, North Miami Beach, FL 33160',
            'phone' => '(305) 555-0101',
            'hours' => 'Mon-Fri: 8:00 AM - 9:00 PM',
            'rating' => 4.8,
            'reviews_count' => 128,
            'amenities' => ['High-Speed Wi-Fi', 'Private Offices', 'Meeting Rooms', 'Cafeteria'],
            'services' => [
                ['name' => 'Day Pass', 'price' => '$30.00'],
                ['name' => 'Monthly Membership', 'price' => '$300.00'],
                ['name' => 'Meeting Room (Hourly)', 'price' => '$50.00'],
            ],
            'time_slots' => ['09:30', '10:15', '11:15', '13:00'],
        ],
        2 => [
            'title' => 'Innovation Lounge - Merrick Park',
            'description' => 'An exclusive lounge for entrepreneurs and professionals, offering a quiet, upscale environment for focus and networking.',
            'image' => 'https://placehold.co/1200x400/FFFFFF/00B4D8?text=NextSpace+Banner+2',
            'address' => '4250 Salzedo Street, Suite 1425 Coral Gables, FL 33146',
            'phone' => '(305) 555-0102',
            'hours' => 'Mon-Sat: 9:00 AM - 10:00 PM',
            'rating' => 4.7,
            'reviews_count' => 95,
            'amenities' => ['24/7 Access', 'Event Space', 'Lounge Area'],
            'services' => [
                ['name' => 'Hot Desk (Daily)', 'price' => '$40.00'],
                ['name' => 'Dedicated Desk', 'price' => '$450.00'],
                ['name' => 'Event Booking', 'price' => 'Custom'],
            ],
            'time_slots' => ['10:00', '11:00', '14:00', '15:30'],
        ],
        3 => [
            'title' => 'Event Venue - Coral Gables',
            'description' => 'A versatile event space perfect for workshops, product launches, and private gatherings. Fully customizable layout.',
            'image' => 'https://placehold.co/1200x400/FFFFFF/00B4D8?text=NextSpace+Banner+3',
            'address' => '360 San Lorenzo Avenue, Suite 1430 Coral Gables, FL 33146',
            'phone' => '(305) 555-0103',
            'hours' => 'By Appointment',
            'rating' => 4.2,
            'reviews_count' => 210,
            'amenities' => ['Audiovisual Equipment', 'Catering Options', 'High Capacity'],
            'services' => [
                ['name' => 'Half-Day Rental', 'price' => '$500.00'],
                ['name' => 'Full-Day Rental', 'price' => '$900.00'],
                ['name' => 'Weekend Package', 'price' => '$1500.00'],
            ],
            'time_slots' => ['09:00', '10:00', '11:00', '13:00'],
        ],
        4 => [
            'title' => 'Digital Nomad Hub - American Dream',
            'description' => 'A vibrant spot for remote workers and digital nomads, offering comfort and connectivity within the bustling American Dream complex.',
            'image' => 'https://placehold.co/1200x400/FFFFFF/00B4D8?text=NextSpace+Banner+4',
            'address' => '1 American Dream Way, #F225 East Rutherford, NJ 07073',
            'phone' => '(201) 555-0104',
            'hours' => 'Mon-Sun: 10:00 AM - 9:00 PM',
            'rating' => 4.0,
            'reviews_count' => 150,
            'amenities' => ['High-speed Internet', 'Coffee Bar', 'Charging Stations'],
            'services' => [
                ['name' => 'Hourly Access', 'price' => '$10.00'],
                ['name' => 'Daily Unlimited', 'price' => '$50.00'],
                ['name' => 'Premium Perks', 'price' => 'Inquire'],
            ],
            'time_slots' => ['09:00', '10:00', '11:00', '13:00'],
        ],
        5 => [
            'title' => 'Shared Workspace - Sawgrass Mills',
            'description' => 'Flexible workspace solutions located conveniently at Sawgrass Mills, ideal for short-term projects or impromptu meetings.',
            'image' => 'https://placehold.co/1200x400/FFFFFF/00B4D8?text=NextSpace+Banner+5',
            'address' => '1760 Sawgrass Mills Circle Sunrise, FL 33323-3912',
            'phone' => '(954) 555-0105',
            'hours' => 'Mon-Sun: 11:00 AM - 10:00 PM',
            'rating' => 4.3,
            'reviews_count' => 180,
            'amenities' => ['Printing Services', 'Visitor Parking', 'Breakout Zones'],
            'services' => [
                ['name' => 'Flex Pass (5 days)', 'price' => '$150.00'],
                ['name' => 'Virtual Office', 'price' => '$80.00'],
                ['name' => 'Conference Room', 'price' => '$75/hour'],
            ],
            'time_slots' => ['09:00', '10:00', '11:00', '13:00'],
        ],
        6 => [
            'title' => 'Executive Suites - Boca Raton',
            'description' => 'Premium executive suites for businesses seeking a prestigious address and comprehensive support services.',
            'image' => 'https://placehold.co/1200x400/FFFFFF/00B4D8?text=NextSpace+Banner+6',
            'address' => '344 Plaza Real, Suite 1433 Boca Raton, FL 33432-3937',
            'phone' => '(561) 555-0106',
            'hours' => 'Mon-Fri: 9:00 AM - 5:00 PM',
            'rating' => 4.6,
            'reviews_count' => 110,
            'amenities' => ['Reception Services', 'Mail Handling', 'Fitness Center Access'],
            'services' => [
                ['name' => 'Standard Suite', 'price' => '$1200/month'],
                ['name' => 'Executive Suite', 'price' => '$2500/month'],
                ['name' => 'Business Address', 'price' => '$99/month'],
            ],
            'time_slots' => ['09:00', '10:00', '11:00', '13:00'],
        ],
    ];

    public function show($id)
    {
        $nextspace = $this->nextspacesData[$id] ?? null;

        if (!$nextspace) {
            abort(404);
        }

        return view('nextspaces.show', compact('nextspace', 'id'));
    }
}