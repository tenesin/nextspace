<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nextspace;
use App\Models\TimeSlot; // Import TimeSlot model

class NextspaceController extends Controller
{
    public function index()
    {
        $nextspaces = NextSpace::latest()->paginate(4); // 6 item per halaman, bisa kamu sesuaikan
        return view('/dashboard', compact('nextspaces'));
    }

    public function show($id)
    {
        $nextspace = Nextspace::findOrFail($id);

        // Ensure time_slots is an array and fetch names for display
        $rawTimeSlotIds = $nextspace->time_slots ?? [];
        $timeSlotIds = is_string($rawTimeSlotIds) ? json_decode($rawTimeSlotIds, true) : $rawTimeSlotIds;
        $timeSlotIds = is_array($timeSlotIds) ? $timeSlotIds : [];
        $displayTimeSlots = TimeSlot::whereIn('id', $timeSlotIds)->pluck('slot')->toArray();


        return view('nextspaces.show', compact('nextspace', 'id', 'displayTimeSlots'));
    }
}
