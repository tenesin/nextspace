<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HistoryController extends Controller
{
    public function index(Request $request)
{
    $query = Booking::where('user_id', Auth::id());

    switch ($request->input('sort')) {
        case 'oldest':
            $query->orderBy('created_at', 'asc');
            break;
        case 'highest':
            $query->orderBy('price', 'desc');
            break;
        case 'lowest':
            $query->orderBy('price', 'asc');
            break;
        default:
            $query->orderBy('created_at', 'desc');
    }

    $bookings = $query->paginate(10);

    return view('history.index', compact('bookings'));
}
    public function showBookingDetails($booking_id)
{
    $booking = Booking::where('booking_id', $booking_id)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();

    // Penalty logic
    $now = now();
    $bookedDateTime = $booking->booked_for ? $booking->booked_for->copy() : null;
    if ($bookedDateTime && $booking->booked_time_slot) {
        try {
            $bookedDateTime->setTimeFromTimeString($booking->booked_time_slot);
        } catch (\Exception $ex) {}
    }
    $penalty = false;
    if ($bookedDateTime) {
        $diff = $bookedDateTime->diffInMinutes($now, false);
        $penalty = $diff > -60;
    }

    return view('history.booking-details', compact('booking', 'penalty'));
}

    public function checkIn(Booking $booking)
{
    if ($booking->user_id !== Auth::id()) {
        abort(403);
    }
    if (!in_array(strtolower($booking->status), ['confirmed', 'paid'])) {
        return back()->with('error', 'You can only check in for confirmed bookings.');
    }
    $booking->status = 'Checked In';
    $booking->save();

    return back()->with('success', 'Success check in!');
}

public function cancel(Booking $booking)
{
    if ($booking->user_id !== Auth::id()) {
        abort(403);
    }

    $now = now();
    $bookedDateTime = $booking->booked_for->copy();
    if ($booking->booked_time_slot) {
        $bookedDateTime->setTimeFromTimeString($booking->booked_time_slot);
    }

    $penalty = false;
    $penaltyAmount = 0;
    if ($bookedDateTime->diffInMinutes($now, false) > -60) {
        $penalty = true;
        $penaltyAmount = $booking->price * 0.25;
        // Optionally, store penalty in DB
    }

    $booking->status = $penalty ? 'Canceled (Late)' : 'Canceled';
    $booking->save();

    // Redirect to confirmation page
    return view('history.cancel-confirmation', [
        'booking' => $booking,
        'penalty' => $penalty,
        'penaltyAmount' => $penaltyAmount,
    ]);
}

public function remove(Booking $booking)
{
    if ($booking->user_id !== Auth::id()) {
        abort(403);
    }
    // You can use soft delete if your Booking model uses SoftDeletes
    $booking->delete();

    return back()->with('status', 'Booking removed from your history.');
}
public function invoice($booking_id)
{
    // Your logic to generate or show the invoice
    // Example:
    $booking = Booking::where('booking_id', $booking_id)->firstOrFail();
    return view('history.invoice', compact('booking'));
}
}