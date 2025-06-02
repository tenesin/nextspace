<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth; 

class PaymentController extends Controller
{
    private $nextspacesData = [
        1 => ['title' => 'The Creative Hub - North Miami Beach', 'price' => 30.00, 'image' => 'https://placehold.co/400x250/FFFFFF/00B4D8?text=Space+1', 'address' => '3933 NE 163rd St', 'hours' => 'Mon-Fri: 8AM-9PM', 'time_slots' => ['09:30', '10:15', '11:15', '13:00']],
        2 => ['title' => 'Innovation Lounge - Merrick Park', 'price' => 40.00, 'image' => 'https://placehold.co/400x250/FFFFFF/00B4D8?text=Space+2', 'address' => '4250 Salzedo Street', 'hours' => 'Mon-Sat: 9AM-10PM', 'time_slots' => ['10:00', '11:00', '14:00', '15:30']],
        3 => ['title' => 'Event Venue - Coral Gables', 'price' => 500.00, 'image' => 'https://placehold.co/400x250/FFFFFF/00B4D8?text=Space+3', 'address' => '360 San Lorenzo Avenue', 'hours' => 'By Appointment', 'time_slots' => ['09:00', '10:00', '11:00', '13:00']],
        4 => ['title' => 'Digital Nomad Hub - American Dream', 'price' => 30.00, 'image' => 'https://placehold.co/400x250/FFFFFF/00B4D8?text=Space+4', 'address' => '1 American Dream Way', 'hours' => 'Mon-Sun: 10AM-9PM', 'time_slots' => ['09:00', '10:00', '11:00', '13:00']],
        5 => ['title' => 'Shared Workspace - Sawgrass Mills', 'price' => 45.00, 'image' => 'https://placehold.co/400x250/FFFFFF/00B4D8?text=Space+5', 'address' => '1760 Sawgrass Mills Circle', 'hours' => 'Mon-Sun: 11AM-10PM', 'time_slots' => ['09:00', '10:00', '11:00', '13:00']],
        6 => ['title' => 'Executive Suites - Boca Raton', 'price' => 150.00, 'image' => 'https://placehold.co/400x250/FFFFFF/00B4D8?text=Space+6', 'address' => '344 Plaza Real', 'hours' => 'Mon-Fri: 9AM-5PM', 'time_slots' => ['09:00', '10:00', '11:00', '13:00']],
    ];

    public function showPaymentForm($nextspace_id)
    {
        $nextspace = $this->nextspacesData[$nextspace_id] ?? null;

        if (!$nextspace) {
            abort(404);
        }

        return view('payment.form', compact('nextspace', 'nextspace_id'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'nextspace_id' => 'required|integer',
            'selected_time_slot' => 'required|string',
            'card_number' => 'required|string',
            'expiry_date' => 'required|string',
            'cvc' => 'required|string',
        ]);

        $nextspace_id = $request->input('nextspace_id');
        $selected_time_slot = $request->input('selected_time_slot');

        $nextspace = $this->nextspacesData[$nextspace_id] ?? null;

        if (!$nextspace) {
            return redirect()->back()->withErrors('NextSpace not found.');
        }

        // --- Simulate payment processing ---
        $paymentSuccessful = true; // Always successful for demonstration

        if ($paymentSuccessful) {
            // Generate a unique booking ID (e.g., for scanning)
            $booking_id = uniqid('NSB_'); // NSB_ for NextSpaceBooking

            // --- SAVE BOOKING TO DATABASE ---
            Booking::create([
                'user_id' => Auth::id(), // Get the ID of the currently logged-in user
                'nextspace_id' => $nextspace_id,
                'booking_id' => $booking_id,
                'nextspace_title' => $nextspace['title'],
                'nextspace_address' => $nextspace['address'],
                'nextspace_image_url' => $nextspace['image'], // Save image URL
                'booked_time_slot' => $selected_time_slot,
                'booking_date' => now()->toDateString(), // Current date
                'price' => $nextspace['price'],
                'status' => 'confirmed',
            ]);

            // Redirect directly to history index with a success message
            return redirect()->route('history.index')->with('status', 'Payment confirmed! Your booking has been saved.');
        } else {
            return redirect()->back()->withErrors(['payment' => 'Payment failed. Please try again.']);
        }
    }

    public function success()
    {
        return view('payment.success');
    }
}