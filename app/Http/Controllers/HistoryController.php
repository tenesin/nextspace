<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('status', 'Please log in to view your history.');
        }

        // Try using the full namespace path
        $bookings = \App\Models\Booking::where('user_id', $user->id)->latest()->get();

        return view('history.index', compact('bookings'));
    }
}