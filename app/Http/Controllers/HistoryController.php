<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('status', 'Please log in to view your history.');
        }

        $bookings = Booking::where('user_id', $user->id)->latest()->get();

        return view('history.index', compact('bookings'));
    }

    public function showBookingDetails($booking_id)
    {
        $booking = Booking::where('booking_id', $booking_id)
                          ->where('user_id', Auth::id())
                          ->firstOrFail();

        return view('history.booking-details', compact('booking'));
    }
}