<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use App\Models\Booking;

class PenaltyController extends Controller
{
    public function penalty($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        if ($booking->user_id !== Auth::id() || !$booking->penalty_amount || $booking->penalty_paid) {
            abort(403);
        }
        return view('payment.penalty', compact('booking'));
    }

    public function payPenalty(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        if ($booking->user_id !== Auth::id() || !$booking->penalty_amount || $booking->penalty_paid) {
            abort(403);
        }
        // Simulate payment logic here...
        $booking->penalty_paid = true;
        $booking->save();

        return redirect()->route('history.index')->with('status', 'Penalty paid successfully!');
    }
}