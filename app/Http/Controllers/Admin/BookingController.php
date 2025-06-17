<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Notifications\BookingCheckedIn;

class BookingController extends Controller
{
    /**
     * Show the check-in page for a booking.
     */
    

    public function manualCheckin(Request $request)
    {
        $request->validate(['booking_id' => 'required']);
        $booking = Booking::where('booking_id', $request->booking_id)->first();

        if (!$booking) {
            return back()->with('error', 'Booking ID not found.');
        }

        $booking->status = 'checked in';
        $booking->checked_in_at = now();
        $booking->save();

        // Optionally, notify the user (if you have notifications set up)
        if ($booking->user) {
            $booking->user->notify(new BookingCheckedIn($booking));
        }

        return back()->with('success', 'Check-in successful and user notified!');
    }
}