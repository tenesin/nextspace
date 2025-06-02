<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nextspace;
use App\Models\Amenity;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class NextspaceController extends Controller
{
    public function index()
    {
        $nextspaces = Nextspace::all();
        return view('admin.nextspaces.index', compact('nextspaces'));
    }

    public function create()
    {
        $amenities = Amenity::all();
        $services = Service::all();
        return view('admin.nextspaces.create', compact('amenities', 'services'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|url',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'hours' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'amenities_hidden_input' => 'nullable|json',
            'services_hidden_input' => 'nullable|json',
            'time_slots' => 'nullable|json',
            'base_price' => 'nullable|numeric|min:0',
        ]);

        $amenityIds = json_decode($request->input('amenities_hidden_input'), true) ?? [];
        $serviceIds = json_decode($request->input('services_hidden_input'), true) ?? [];

        // Prepare data for Nextspace::create, including JSON columns with IDs
        $nextspaceData = Arr::except($validatedData, ['amenities_hidden_input', 'services_hidden_input']);
        $nextspaceData['amenities'] = $amenityIds; // Store array of IDs (Eloquent will cast to JSON)
        $nextspaceData['services'] = $serviceIds; // Store array of IDs (Eloquent will cast to JSON)

        $nextspace = Nextspace::create($nextspaceData);
        
        // Still sync pivot tables for relationships (for admin form pre-selection and consistency)
        $nextspace->amenities()->sync($amenityIds);
        $nextspace->services()->sync($serviceIds);

        return redirect()->route('admin.nextspaces.index')->with('success', 'NextSpace created successfully.');
    }

    public function edit(Nextspace $nextspace)
    {
        $amenities = Amenity::all();
        $services = Service::all();
        
        // selectedAmenities and selectedServices are already arrays of IDs from the model's casting
        $selectedAmenities = $nextspace->amenities ?? [];
        $selectedServices = $nextspace->services ?? [];

        return view('admin.nextspaces.edit', compact('nextspace', 'amenities', 'services', 'selectedAmenities', 'selectedServices'));
    }

    public function update(Request $request, Nextspace $nextspace)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|url',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'hours' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'amenities_hidden_input' => 'nullable|json',
            'services_hidden_input' => 'nullable|json',
            'time_slots' => 'nullable|json',
            'base_price' => 'nullable|numeric|min:0',
        ]);
        
        $amenityIds = json_decode($request->input('amenities_hidden_input'), true) ?? [];
        $serviceIds = json_decode($request->input('services_hidden_input'), true) ?? [];

        // Prepare data for Nextspace::update, including JSON columns with IDs
        $nextspaceData = Arr::except($validatedData, ['amenities_hidden_input', 'services_hidden_input']);
        $nextspaceData['amenities'] = $amenityIds; // Store array of IDs (Eloquent will cast to JSON)
        $nextspaceData['services'] = $serviceIds; // Store array of IDs (Eloquent will cast to JSON)

        $nextspace->update($nextspaceData);

        // Still sync pivot tables for relationships
        $nextspace->amenities()->sync($amenityIds);
        $nextspace->services()->sync($serviceIds);

        return redirect()->route('admin.nextspaces.index')->with('success', 'NextSpace updated successfully.');
    }

    public function destroy(Nextspace $nextspace)
    {
        $nextspace->delete();
        return redirect()->route('admin.nextspaces.index')->with('success', 'NextSpace deleted successfully.');
    }
}
