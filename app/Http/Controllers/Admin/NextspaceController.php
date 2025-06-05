<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nextspace;
use App\Models\Amenity;
use App\Models\Service;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class NextspaceController extends Controller
{
    public function index()
    {
        $nextspaces = Nextspace::with(['amenities', 'services', 'timeSlots'])->get();
        return view('admin.nextspaces.index', compact('nextspaces'));
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
            'hours_hidden_input' => 'nullable|json',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'amenities_hidden_input' => 'nullable|json',
            'services_hidden_input' => 'nullable|json',
            'time_slots_hidden_input' => 'nullable|json',
            'base_price' => 'nullable|numeric|min:0',
        ]);

        // Parse JSON inputs
        $amenityIds = $this->parseJsonInput($request->input('amenities_hidden_input'));
        $serviceIds = $this->parseJsonInput($request->input('services_hidden_input'));
        $hoursArray = $this->parseJsonInput($request->input('hours_hidden_input'));
        $timeSlotIds = $this->parseJsonInput($request->input('time_slots_hidden_input'));

        // Prepare data for creation
        $nextspaceData = Arr::except($validatedData, [
            'amenities_hidden_input', 
            'services_hidden_input', 
            'hours_hidden_input', 
            'time_slots_hidden_input'
        ]);
        
        $nextspaceData['amenities'] = $amenityIds;
        $nextspaceData['services'] = $serviceIds;
        $nextspaceData['hours'] = $hoursArray;
        $nextspaceData['time_slots'] = $timeSlotIds;

        // Create nextspace
        $nextspace = Nextspace::create($nextspaceData);
        
        // Sync relationships (for pivot tables if you're using both approaches)
        $nextspace->amenities()->sync($amenityIds);
        $nextspace->services()->sync($serviceIds);
        $nextspace->timeSlots()->sync($timeSlotIds);

        return redirect()->route('admin.nextspaces.index')
            ->with('success', 'NextSpace created successfully.');
    }

    public function show(Nextspace $nextspace)
    {
        $nextspace->load(['amenities', 'services', 'timeSlots']);
        return view('admin.nextspaces.show', compact('nextspace'));
    }

    public function edit(Nextspace $nextspace)
{
    // Ambil ulang dari database dengan relasi
    $nextspace = Nextspace::with(['amenities', 'services'])->findOrFail($nextspace->id);

    $amenities = Amenity::all();
    $services = Service::all();
    $timeSlots = TimeSlot::all();
    
    $selectedAmenities = $nextspace->amenities->pluck('id')->toArray();
    $selectedServices = $nextspace->services->pluck('id')->toArray();
    $selectedTimeSlots = $this->parseJsonInput($nextspace->time_slots);

    return view('admin.nextspaces.edit', compact(
        'nextspace', 
        'amenities', 
        'services', 
        'timeSlots', 
        'selectedAmenities', 
        'selectedServices', 
        'selectedTimeSlots'
    ));
}


    public function update(Request $request, Nextspace $nextspace)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|url',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'hours_hidden_input' => 'nullable|json',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'amenities_hidden_input' => 'nullable|json',
            'services_hidden_input' => 'nullable|json',
            'time_slots_hidden_input' => 'nullable|json',
            'base_price' => 'nullable|numeric|min:0',
        ]);
        
        // Parse JSON inputs
        $amenityIds = $this->parseJsonInput($request->input('amenities_hidden_input'));
        $serviceIds = $this->parseJsonInput($request->input('services_hidden_input'));
        $hoursArray = $this->parseJsonInput($request->input('hours_hidden_input'));
        $timeSlotIds = $this->parseJsonInput($request->input('time_slots_hidden_input'));

        // Prepare data for update
        $nextspaceData = Arr::except($validatedData, [
            'amenities_hidden_input', 
            'services_hidden_input', 
            'hours_hidden_input', 
            'time_slots_hidden_input'
        ]);
        
        $nextspaceData['amenities'] = $amenityIds;
        $nextspaceData['services'] = $serviceIds;
        $nextspaceData['hours'] = $hoursArray;
        $nextspaceData['time_slots'] = $timeSlotIds;

        // Update nextspace
        $nextspace->update($nextspaceData);

        // Sync relationships - FIXED: Added missing timeSlots sync and corrected services sync
        $nextspace->amenities()->sync($amenityIds);
        $nextspace->services()->sync($serviceIds); // FIXED: was syncing timeSlotIds
        $nextspace->timeSlots()->sync($timeSlotIds); // ADDED: missing timeSlots sync

        return redirect()->route('admin.nextspaces.index')
            ->with('success', 'NextSpace updated successfully.');
    }

    public function destroy(Nextspace $nextspace)
    {
        // Detach relationships before deleting (optional, depends on your foreign key constraints)
        $nextspace->amenities()->detach();
        $nextspace->services()->detach();
        $nextspace->timeSlots()->detach();
        
        $nextspace->delete();
        
        return redirect()->route('admin.nextspaces.index')
            ->with('success', 'NextSpace deleted successfully.');
    }

    /**
     * Helper method to parse JSON input safely
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