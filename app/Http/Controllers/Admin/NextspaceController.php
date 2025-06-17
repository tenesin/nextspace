<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nextspace;
use App\Models\Booking;
use App\Models\Amenity;
use App\Models\Service;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use App\Models\User;
use App\Exports\NextspacesExport;
use Maatwebsite\Excel\Facades\Excel;

class NextspaceController extends Controller
{
    public function index()
    {
        $users = User::withCount('bookings')->get();
        $nextspaces = Nextspace::all();
        $usersWithOrders = User::whereHas('bookings')->count();

        return view('admin.nextspaces.index', compact('users', 'nextspaces', 'usersWithOrders'));
    }

    public function create()
    {
        $amenities = Amenity::all();
        $services = Service::all();
        $timeSlots = TimeSlot::all();
        return view('admin.nextspaces.create', compact('amenities', 'services', 'timeSlots'));
    }

    public function show(Nextspace $nextspace)
    {
        $nextspace->load(['amenities', 'services', 'timeSlots', 'hours']);
        return view('admin.nextspaces.show', compact('nextspace'));
    }

    public function edit($id)
    {
        $nextspace = Nextspace::with(['amenities', 'services', 'timeSlots', 'hours'])->findOrFail($id);
        $allAmenities = Amenity::all();
        $allServices = Service::all();
        $allTimeSlots = TimeSlot::all();
        return view('admin.nextspaces.edit', compact('nextspace', 'allAmenities', 'allServices', 'allTimeSlots'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|url',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'base_price' => 'nullable|numeric|min:0',
        ]);

        $nextspace = Nextspace::create($validatedData);

        // Handle hours selection from form, prevent duplicates
        $hoursInput = $request->input('hours', []);
        $hoursData = [];
        foreach ($hoursInput as $hour) {
            if (str_contains($hour, 'Monday - Friday')) {
                $hoursData['mon-fri'] = [
                    'nextspace_id' => $nextspace->id,
                    'day_type' => 'mon-fri',
                    'open_time' => '08:00',
                    'close_time' => '17:00',
                ];
            }
            if (str_contains($hour, 'Saturday - Sunday')) {
                $hoursData['sat-sun'] = [
                    'nextspace_id' => $nextspace->id,
                    'day_type' => 'sat-sun',
                    'open_time' => '08:00',
                    'close_time' => '17:00',
                ];
            }
        }
        foreach ($hoursData as $hour) {
            $nextspace->hours()->create($hour);
        }

        // Sync relationships
        $nextspace->amenities()->sync($request->input('amenity_ids', []));
        $nextspace->services()->sync($request->input('service_ids', []));
        $timeSlotIds = $request->input('time_slot_ids', []);
        $capacities = $request->input('capacities', []);
        $syncData = [];
        foreach ($timeSlotIds as $slotId) {
            $syncData[$slotId] = ['capacity' => $capacities[$slotId] ?? 1];
        }
        $nextspace->timeSlots()->sync($syncData);

        return redirect()->route('admin.nextspaces.index')
            ->with('success', 'NextSpace created successfully.');
    }

    public function update(Request $request, Nextspace $nextspace)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|url',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'base_price' => 'nullable|numeric|min:0',
        ]);

        $nextspace->update($validatedData);

        // Remove old hours
        $nextspace->hours()->delete();

        // Prepare new hours, only one per day_type
        $hoursInput = $request->input('hours', []);
        $hoursData = [];
        foreach ($hoursInput as $hour) {
            if (str_contains($hour, 'Monday - Friday')) {
                $hoursData['mon-fri'] = [
                    'nextspace_id' => $nextspace->id,
                    'day_type' => 'mon-fri',
                    'open_time' => '08:00',
                    'close_time' => '17:00',
                ];
            }
            if (str_contains($hour, 'Saturday - Sunday')) {
                $hoursData['sat-sun'] = [
                    'nextspace_id' => $nextspace->id,
                    'day_type' => 'sat-sun',
                    'open_time' => '08:00',
                    'close_time' => '17:00',
                ];
            }
        }
        foreach ($hoursData as $hour) {
            $nextspace->hours()->create($hour);
        }

        // Sync relationships
        $nextspace->amenities()->sync($request->input('amenity_ids', []));
        $nextspace->services()->sync($request->input('service_ids', []));
        $timeSlotIds = $request->input('time_slot_ids', []);
        $capacities = $request->input('capacities', []);
        $syncData = [];
        foreach ($timeSlotIds as $slotId) {
            $syncData[$slotId] = ['capacity' => $capacities[$slotId] ?? 1];
        }
        $nextspace->timeSlots()->sync($syncData);

        return redirect()->route('admin.nextspaces.index')
            ->with('success', 'NextSpace updated successfully.');
    }

    public function destroy(Nextspace $nextspace)
    {
        $nextspace->amenities()->detach();
        $nextspace->services()->detach();
        $nextspace->timeSlots()->detach();
        $nextspace->hours()->delete();
        $nextspace->delete();

        return redirect()->route('admin.nextspaces.index')
            ->with('success', 'NextSpace deleted successfully.');
    }

    public function exportReport()
    {
        return Excel::download(new NextspacesExport, 'nextspaces_business_report.xlsx');
    }

    public function showCheckin($bookingId)
{
    $booking = Booking::findOrFail($bookingId);
    return view('admin.bookings.checkin', compact('booking'));
}

public function processCheckin($bookingId)
{
    $booking = Booking::findOrFail($bookingId);
    $booking->status = 'checked in';
    $booking->checked_in_at = now();
    $booking->save();

    return redirect()->route('admin.booking.checkin.show', $bookingId)
        ->with('success', 'Check-in berhasil!');
}
}