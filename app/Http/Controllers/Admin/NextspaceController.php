<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nextspace;
use App\Models\Amenity;
use App\Models\Service;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\User;

class NextspaceController extends Controller
{
    public function index()
    {
        $nextspaces = Nextspace::all();
    $users = User::all();
    return view('admin.nextspaces.index', compact('nextspaces', 'users'));
    }

    public function create()
{
    $amenities = Amenity::all();
    $services = Service::all();
    $timeSlots = TimeSlot::all();
    return view('admin.nextspaces.create', compact('amenities', 'services', 'timeSlots'));
}

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|url',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'hours' => 'nullable|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'amenities' => 'array',
            'services' => 'array',
            'time_slots' => 'array',
            'base_price' => 'nullable|numeric|min:0',
        ]);

        // Prepare data for creation (exclude relationship arrays)
        $nextspaceData = Arr::except($validatedData, [
            'amenities',
            'services',
            'time_slots'
        ]);

        // Add hours if present
        if ($request->filled('hours')) {
            $nextspaceData['hours'] = $request->input('hours');
        }

        // Create nextspace
        $nextspace = Nextspace::create($nextspaceData);

        // Sync relationships
        $nextspace->amenities()->sync($request->input('amenity_ids', []));
        $nextspace->services()->sync($request->input('service_ids', []));
        $nextspace->timeSlots()->sync($request->input('time_slot_ids', []));

        return redirect()->route('admin.nextspaces.index')
            ->with('success', 'NextSpace created successfully.');
    }

    public function show(Nextspace $nextspace)
    {
        $nextspace->load(['amenities', 'services', 'timeSlots']);
        return view('admin.nextspaces.show', compact('nextspace'));
    }

    public function edit($id)
{
    $nextspace = Nextspace::with(['amenities', 'services', 'timeSlots'])->findOrFail($id);
    $allAmenities = Amenity::all();
    $allServices = Service::all();
    $allTimeSlots = TimeSlot::all();
    return view('admin.nextspaces.edit', compact('nextspace', 'allAmenities', 'allServices', 'allTimeSlots'));
}

    public function update(Request $request, Nextspace $nextspace)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|url',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'hours' => 'nullable|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'amenities' => 'array',
            'services' => 'array',
            'time_slots' => 'array',
            'base_price' => 'nullable|numeric|min:0',
        ]);

        // Prepare data for update (exclude relationship arrays)
        $nextspaceData = Arr::except($validatedData, [
            'amenities',
            'services',
            'time_slots'
        ]);

        // Add hours if present
        if ($request->filled('hours')) {
            $nextspaceData['hours'] = $request->input('hours');
        }

        // Update nextspace
        $nextspace->update($nextspaceData);

        // Sync relationships
        $nextspace->amenities()->sync($request->input('amenity_ids', []));
$nextspace->services()->sync($request->input('service_ids', []));
$nextspace->timeSlots()->sync($request->input('time_slot_ids', []));

        return redirect()->route('admin.nextspaces.index')
            ->with('success', 'NextSpace updated successfully.');
    }

    public function destroy(Nextspace $nextspace)
    {
        $nextspace->amenities()->detach();
        $nextspace->services()->detach();
        $nextspace->timeSlots()->detach();
        $nextspace->delete();

        return redirect()->route('admin.nextspaces.index')
            ->with('success', 'NextSpace deleted successfully.');
    }

    /**
     * Helper method to parse JSON input safely (not used anymore, but kept for reference)
     */
    private function parseJsonInput($input)
    {
        if (is_null($input) || $input === '') {
            return [];
        }
        if (is_array($input)) {
            return $input;
        }
        $decoded = json_decode($input, true);
        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Get time slot names for display (helper method)
     */
    public function getTimeSlotNames(array $timeSlotIds)
    {
        if (empty($timeSlotIds)) {
            return collect();
        }
        return TimeSlot::whereIn('id', $timeSlotIds)
            ->pluck('slot', 'id');
    }
}