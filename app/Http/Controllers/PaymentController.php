<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Nextspace;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function showPaymentForm($nextspace_id)
    {
        $nextspace = Nextspace::with(['timeSlots'])->findOrFail($nextspace_id);
        $availableTimeSlots = $nextspace->timeSlots;
        $allServices = Service::all();

        return view('payment.form', compact('nextspace', 'nextspace_id', 'availableTimeSlots', 'allServices'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'nextspace_id' => 'required|integer',
            'booking_date' => 'required|date|after_or_equal:today',
            'selected_time_slot_id' => 'required|integer|exists:time_slots,id',
            'selected_service_ids' => 'nullable|array',
            'selected_service_ids.*' => 'exists:services,id',
            'payment_method' => 'required|string',
            'card_number' => 'required|string',
            'expiry_date' => 'required|string',
            'cvc' => 'required|string',
        ]);

        $nextspace_id = $request->input('nextspace_id');
        $selected_time_slot_id = $request->input('selected_time_slot_id');
        $selected_service_ids = $request->input('selected_service_ids') ?? [];
        $payment_method = $request->input('payment_method');

        $nextspace = Nextspace::with(['timeSlots'])->findOrFail($nextspace_id);
        $selectedTimeSlot = $nextspace->timeSlots->find($selected_time_slot_id);

        // Capacity check
        if (!$selectedTimeSlot || $selectedTimeSlot->pivot->capacity <= 0) {
            return back()->withErrors(['selected_time_slot_id' => 'This time slot is fully booked.']);
        }

        $selectedServices = Service::whereIn('id', $selected_service_ids)->get();

        $totalPrice = $nextspace->base_price;
        foreach ($selectedServices as $service) {
            $totalPrice += $service->price;
        }

        $booking_id = uniqid('NSB_');
        $bookedServicesDetails = $selectedServices->map(function($service) {
            return ['name' => $service->name, 'price' => $service->price];
        })->toArray();

        // Set status based on payment method
        $status = ($payment_method === 'cash') ? 'pending' : 'confirmed';

        // Simulate payment success for non-cash methods
        $paymentSuccessful = ($payment_method === 'cash') ? true : true; // Adjust if you have real payment logic

        if ($paymentSuccessful) {
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
                'price' => $totalPrice,
                'status' => $status,
                'selected_services_details' => json_encode($bookedServicesDetails),
            ]);

            // Reduce capacity in pivot table
            $nextspace->timeSlots()->updateExistingPivot($selected_time_slot_id, [
                'capacity' => max($selectedTimeSlot->pivot->capacity - 1, 0)
            ]);

            return redirect()->route('history.index')->with('status', 'Booking berhasil! Silakan lakukan pembayaran di tempat jika memilih Bayar di Tempat.');
        } else {
            return redirect()->back()->withErrors(['payment' => 'Payment failed. Please try again.']);
        }
    }

    public function success()
    {
        return view('payment.success');
    }
}