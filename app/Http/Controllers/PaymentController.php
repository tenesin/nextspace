<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Nextspace;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function showPaymentForm($nextspace_id)
    {
        $nextspace = Nextspace::findOrFail($nextspace_id);

        if (is_string($nextspace->time_slots)) {
            $nextspace->time_slots = json_decode($nextspace->time_slots, true);
        }
        $nextspace->time_slots = is_array($nextspace->time_slots) ? $nextspace->time_slots : [];

        return view('payment.form', compact('nextspace', 'nextspace_id'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'nextspace_id' => 'required|integer',
            'booking_date' => 'required|date|after_or_equal:today',
            'selected_time_slot' => 'required|string',
            'card_number' => 'required|string',
            'expiry_date' => 'required|string',
            'cvc' => 'required|string',
        ]);

        $nextspace_id = $request->input('nextspace_id');
        $selected_time_slot = $request->input('selected_time_slot');
        $booked_for_date = $request->input('booking_date');

        $nextspace = Nextspace::findOrFail($nextspace_id);

        $paymentSuccessful = true;

        if ($paymentSuccessful) {
            $booking_id = uniqid('NSB_');

            Booking::create([
                'user_id' => Auth::id(),
                'nextspace_id' => $nextspace->id,
                'booking_id' => $booking_id,
                'nextspace_title' => $nextspace->title,
                'nextspace_address' => $nextspace->address,
                'nextspace_image_url' => $nextspace->image,
                'booked_time_slot' => $selected_time_slot,
                'booked_for' => $booked_for_date,
                'booking_date' => now()->toDateString(),
                'price' => $nextspace->base_price,
                'status' => 'confirmed',
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
