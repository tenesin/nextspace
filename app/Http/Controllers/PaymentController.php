<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Nextspace;
use App\Models\TimeSlot;
use App\Models\Service; // Import Service model
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function showPaymentForm($nextspace_id)
    {
        $nextspace = Nextspace::findOrFail($nextspace_id);

        $rawTimeSlotIds = $nextspace->time_slots ?? [];
        $timeSlotIds = is_string($rawTimeSlotIds) ? json_decode($rawTimeSlotIds, true) : $rawTimeSlotIds;
        $timeSlotIds = is_array($timeSlotIds) ? $timeSlotIds : [];
        $availableTimeSlots = TimeSlot::whereIn('id', $timeSlotIds)->get();

        // Fetch all services to offer for selection
        $allServices = Service::all();

        return view('payment.form', compact('nextspace', 'nextspace_id', 'availableTimeSlots', 'allServices'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'nextspace_id' => 'required|integer',
            'booking_date' => 'required|date|after_or_equal:today',
            'selected_time_slot_id' => 'required|integer|exists:time_slots,id',
            'selected_service_ids' => 'nullable|array', // New validation for selected services (array of IDs)
            'selected_service_ids.*' => 'exists:services,id', // Ensure each selected service ID exists
            'card_number' => 'required|string',
            'expiry_date' => 'required|string',
            'cvc' => 'required|string',
        ]);

        $nextspace_id = $request->input('nextspace_id');
        $selected_time_slot_id = $request->input('selected_time_slot_id');
        $selected_service_ids = $request->input('selected_service_ids') ?? []; // Get selected service IDs

        $nextspace = Nextspace::findOrFail($nextspace_id);
        $selectedTimeSlot = TimeSlot::findOrFail($selected_time_slot_id);

        // Fetch selected service models to get their names and prices
        $selectedServices = Service::whereIn('id', $selected_service_ids)->get();

        // Calculate total price (example: base_price + sum of selected service prices)
        $totalPrice = $nextspace->base_price;
        foreach ($selectedServices as $service) {
            $totalPrice += $service->price;
        }

        $paymentSuccessful = true;

        if ($paymentSuccessful) {
            $booking_id = uniqid('NSB_');

            // Prepare selected service names/prices for storage (e.g., as JSON)
            $bookedServicesDetails = $selectedServices->map(function($service) {
                return ['name' => $service->name, 'price' => $service->price];
            })->toArray();


            Booking::create([
                'user_id' => Auth::id(),
                'nextspace_id' => $nextspace->id,
                'booking_id' => $booking_id,
                'nextspace_title' => $nextspace->title,
                'nextspace_address' => $nextspace->address,
                'nextspace_image_url' => $nextspace->image,
                'booked_time_slot' => $selectedTimeSlot->slot,
                'booked_for' => $request->input('booking_date'),
                'booking_date' => now()->toDateString(),
                'price' => $totalPrice, // Save calculated total price
                'status' => 'confirmed',
                // Add a new column to bookings table for selected services details
                'selected_services_details' => json_encode($bookedServicesDetails),
            ]);

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
